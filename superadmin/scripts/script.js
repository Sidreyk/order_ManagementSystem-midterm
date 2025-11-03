async function fetchJSON(url, options){
    const res = await fetch(url, options);
    return await res.json();
}

function renderUsers(users){
    const tbody = document.getElementById('usersTable');
    if (!Array.isArray(users) || users.length === 0){
        tbody.innerHTML = '<tr><td class="py-3 text-gray-500" colspan="5">No users found</td></tr>';
        return;
    }
    tbody.innerHTML = users.map(u => `
        <tr class="border-b">
            <td class="py-2">${u.username}</td>
            <td class="py-2">${u.email}</td>
            <td class="py-2">${u.role}</td>
            <td class="py-2">${u.status}</td>
            <td class="py-2 flex gap-2">
                ${u.role !== 'super_admin' ? `
                <button data-id="${u.user_id}" data-next="${u.status === 'active' ? 'suspended' : 'active'}" class="px-2 py-1 text-xs rounded bg-yellow-500 text-white toggleBtn">
                    ${u.status === 'active' ? 'Suspend' : 'Activate'}
                </button>
                <button data-id="${u.user_id}" class="px-2 py-1 text-xs rounded bg-red-600 text-white deleteBtn">Delete</button>
                ` : '<span class="text-xs text-gray-400">Protected</span>'}
            </td>
        </tr>
    `).join('');

    tbody.querySelectorAll('.toggleBtn').forEach(btn => btn.addEventListener('click', async (e) => {
        const id = e.currentTarget.dataset.id;
        const next = e.currentTarget.dataset.next;
        const form = new FormData();
        form.append('action','toggle_status');
        form.append('user_id', id);
        form.append('status', next);
        const data = await fetchJSON('./API/auth.php', { method: 'POST', body: form });
        if (data.success) loadUsers(); else Swal.fire('Error', data.message || 'Update failed', 'error');
    }));

    tbody.querySelectorAll('.deleteBtn').forEach(btn => btn.addEventListener('click', async (e) => {
        const id = e.currentTarget.dataset.id;
        const sure = await Swal.fire({ title: 'Delete user?', icon: 'warning', showCancelButton: true });
        if (!sure.isConfirmed) return;
        const form = new FormData(); form.append('action','delete_user'); form.append('user_id', id);
        const data = await fetchJSON('./API/auth.php', { method: 'POST', body: form });
        if (data.success) loadUsers(); else Swal.fire('Error', data.message || 'Delete failed', 'error');
    }));
}

async function loadUsers(){
    const data = await fetchJSON('./API/auth.php?action=list_users');
    if (data.success) renderUsers(data.users); else Swal.fire('Error', data.message || 'Failed to load users', 'error');
}

async function loadProducts() {
    const data = await fetchJSON('../admin/API/admin.php?action=list_products');
    if (!data.success) 
        return Swal.fire('Error', data.message || 'Failed to load products', 'error');

    const tbody = document.getElementById('productsTable');
    tbody.innerHTML = (data.products || []).map(p => {
        const imagePath = p.image_url?.startsWith('http')
            ? p.image_url
            : (p.image_url ? `../uploads/${p.image_url}` : '../assets/no-image.png');

        return `
        <tr class="border-b">
            <td class="py-2 text-center">
                <img src="${imagePath}" alt="${p.name}" class="w-12 h-12 object-cover rounded border"
                     onerror="this.src='../assets/no-image.png'">
            </td>
            <td class="py-2">${p.name}</td>
            <td class="py-2">₱${Number(p.price).toFixed(2)}</td>
            <td class="py-2">${p.status}</td>
            <td class="py-2">
                <button data-id="${p.product_id}" 
                        class="text-xs px-2 py-1 rounded bg-red-600 text-white deleteProductBtn">
                    Delete
                </button>
            </td>
        </tr>`;
    }).join('');

    tbody.querySelectorAll('.deleteProductBtn').forEach(btn => btn.addEventListener('click', async (e) => {
        const id = e.currentTarget.dataset.id;
        const sure = await Swal.fire({ title: 'Remove product?', icon: 'warning', showCancelButton: true });
        if (!sure.isConfirmed) return;
        const form = new FormData(); form.append('action','delete_product'); form.append('product_id', id);
        const resp = await fetchJSON('../admin/API/admin.php', { method: 'POST', body: form });
        if (resp.success) loadProducts(); else Swal.fire('Error', resp.message || 'Delete failed', 'error');
    }));
}


async function loadOrders(){
    const data = await fetchJSON('../admin/API/admin.php?action=list_orders');
    if (!data.success) return Swal.fire('Error', data.message || 'Failed to load orders', 'error');
    const tbody = document.getElementById('ordersTable');
    tbody.innerHTML = (data.orders||[]).map(o => `
        <tr class="border-b">
            <td class="py-2">${o.order_number}</td>
            <td class="py-2">₱${Number(o.total_amount).toFixed(2)}</td>
            <td class="py-2">${o.status}</td>
            <td class="py-2">${o.created_at}</td>
            <td class="py-2">
                <select data-id="${o.order_id}" class="border p-1 rounded text-xs statusSel">
                    <option ${o.status==='pending'?'selected':''}>pending</option>
                    <option ${o.status==='processing'?'selected':''}>processing</option>
                    <option ${o.status==='completed'?'selected':''}>completed</option>
                    <option ${o.status==='cancelled'?'selected':''}>cancelled</option>
                </select>
            </td>
        </tr>
    `).join('');
    tbody.querySelectorAll('.statusSel').forEach(sel => sel.addEventListener('change', async (e) => {
        const id = e.currentTarget.dataset.id;
        const status = e.currentTarget.value;
        const form = new FormData(); form.append('action','update_order_status'); form.append('order_id', id); form.append('status', status);
        const resp = await fetchJSON('../admin/API/admin.php', { method: 'POST', body: form });
        if (!resp.success) Swal.fire('Error', resp.message || 'Update failed', 'error');
    }));
}

async function loadTransactions() {
    const s = document.getElementById('txStart').value;
    const e = document.getElementById('txEnd').value;
    const qs = new URLSearchParams({ action: 'transactions', date_start: s, date_end: e });
    const data = await fetchJSON('../admin/API/admin.php?' + qs.toString());

    if (!data.success)
        return Swal.fire('Error', data.message || 'Failed to load transactions', 'error');

    const tbody = document.getElementById('txTable');
    tbody.innerHTML = data.transactions.map(tx => `
        <tr class="border-b">
            <td class="py-2">${tx.order_number}</td>
            <td class="py-2">₱${parseFloat(tx.total_amount).toFixed(2)}</td>
            <td class="py-2">₱${parseFloat(tx.payment_amount).toFixed(2)}</td>
            <td class="py-2">₱${parseFloat(tx.change_amount).toFixed(2)}</td>
            <td class="py-2">${tx.status}</td>
            <td class="py-2">${tx.created_at}</td>
            <td class="py-2">
                <button class="btn-secondary text-xs px-3 py-1 viewItemsBtn" data-order-id="${tx.order_id}">
                    View Items
                </button>
            </td>
        </tr>
    `).join('');

    document.getElementById('txSum').textContent = '₱' + Number(data.total_sum || 0).toFixed(2);

    // Attach "View Items" button logic
    document.querySelectorAll('.viewItemsBtn').forEach(btn => {
        btn.addEventListener('click', async () => {
            const orderId = btn.dataset.orderId;
            const qs = new URLSearchParams({ action: 'fetch_order_items', order_id: orderId });
            const res = await fetchJSON('../admin/API/admin.php?' + qs.toString());

            if (!res.success) {
                return Swal.fire('Error', res.message || 'Failed to fetch order items', 'error');
            }

            const itemsHTML = res.items.map(i => `
                <tr>
                    <td>${i.product_name}</td>
                    <td>${i.quantity}</td>
                    <td>₱${parseFloat(i.price).toFixed(2)}</td>
                    <td>₱${parseFloat(i.total).toFixed(2)}</td>
                </tr>
            `).join('');

            Swal.fire({
                title: `Order #${orderId} Items`,
                html: `
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>${itemsHTML}</tbody>
                    </table>
                `,
                confirmButtonText: 'Close'
            });
        });
    });
}



document.getElementById('createAdminForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const form = new FormData(e.target);
    form.append('action', 'create_admin');
    const data = await fetchJSON('./API/auth.php', { method: 'POST', body: form });
    if (data.success){
        e.target.reset();
        await Swal.fire('Success', 'Admin created', 'success');
        loadUsers();
    } else {
        Swal.fire('Error', data.message || 'Creation failed', 'error');
    }
});

document.getElementById('refreshBtn').addEventListener('click', loadUsers);
document.getElementById('refreshProductsBtn').addEventListener('click', loadProducts);
document.getElementById('createProductForm').addEventListener('submit', async (e) => {
  e.preventDefault();
  const formData = new FormData(e.target);
  formData.append('action', 'add_product');

  try {
    const res = await fetch('../admin/API/admin.php', { // make sure path points to admin/API/admin.php
      method: 'POST',
      body: formData
    });

    const data = await res.json();

    if (data.success) {
      await Swal.fire({ icon: 'success', title: 'Product added', text: data.message || '' });
      e.target.reset();
      loadProducts();
    } else {
      await Swal.fire({ icon: 'error', title: 'Error', text: data.message || 'Failed to add product' });
    }
  } catch (err) {
    console.error(err);
    await Swal.fire({ icon: 'error', title: 'Error', text: 'Network or server error' });
  }
});


document.getElementById('refreshOrdersBtn').addEventListener('click', loadOrders);
document.getElementById('txFilterBtn').addEventListener('click', loadTransactions);
document.getElementById('txPrintBtn').addEventListener('click', () => {
    const now = new Date().toLocaleString();
    const txTable = document.querySelector('#txTableWrapper').cloneNode(true);

    // Remove "Action" column (both header and cells)
    txTable.querySelectorAll('th:last-child, td:last-child').forEach(el => el.remove());

    const win = window.open('', '_blank');
    const html = `
    <!DOCTYPE html>
    <html>
    <head>
        <title>Transactions Report</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 40px;
                color: #333;
            }
            h1 {
                text-align: center;
                font-size: 20px;
                margin-bottom: 5px;
            }
            p {
                text-align: center;
                font-size: 12px;
                color: #555;
                margin-bottom: 20px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
            }
            th, td {
                border: 1px solid #aaa;
                padding: 8px;
                font-size: 13px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
            tfoot td {
                font-weight: bold;
                background: #fafafa;
            }
            .footer {
                text-align: center;
                font-size: 12px;
                margin-top: 30px;
                color: #777;
            }
            @media print {
                body { margin: 20px; }
                button { display: none; }
            }
        </style>
    </head>
    <body>
        <h1>Transaction History Report</h1>
        <p>Generated on: ${now}</p>
        ${txTable.outerHTML}
        <div class="footer">
            <p>This is the legitimate transaction history.</p>
        </div>
    </body>
    </html>
    `;

    win.document.write(html);
    win.document.close();
    win.focus();
    win.print();
});



function bindLogout(btnId){
    const el = document.getElementById(btnId);
    if (!el) return;
    el.addEventListener('click', async () => {
        const form = new FormData(); form.append('action','logout');
        const data = await fetchJSON('./API/auth.php', { method: 'POST', body: form });
        if (data.success) location.href = './login.php';
    });
}
bindLogout('logoutBtn');
bindLogout('logoutBtnMobile');

async function showGreeting() {
    try {
        const res = await fetchJSON('./API/auth.php?action=get_user_session');
        if (res.success && res.user) {
            const greetEl = document.getElementById('greeting');
            if (greetEl) {
                greetEl.textContent = `Hello, ${res.user.username}! Welcome to the Superadmin Dashboard.`;
            }
        }
    } catch (err) {
        console.error('Greeting error:', err);
    }
}

(async function init(){
    await loadUsers();
    await loadProducts();
    await loadOrders();
    await loadTransactions();
})();