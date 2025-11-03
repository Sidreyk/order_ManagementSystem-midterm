const state = { products: [], items: [], total: 0 };

function formatCurrency(n){ return '₱' + Number(n).toFixed(2); }

async function fetchJSON(url, options){
    const res = await fetch(url, options);
    return await res.json();
}

async function loadProducts(){
    const data = await fetchJSON('./API/admin.php?action=list_products');
    if (!data.success) return Swal.fire('Error', data.message || 'Failed to load products', 'error');
    state.products = data.products;
    const tbody = document.getElementById('productsTable');
    tbody.innerHTML = state.products.map(p => `
        <tr class="border-b">
            <td class="py-2">${p.name}</td>
            <td class="py-2">${formatCurrency(p.price)}</td>
            <td class="py-2">${p.status}</td>
            <td class="py-2"><button data-id="${p.product_id}" class="text-xs px-2 py-1 rounded bg-red-600 text-white deleteProductBtn">Delete</button></td>
        </tr>
    `).join('');
    tbody.querySelectorAll('.deleteProductBtn').forEach(btn => btn.addEventListener('click', async (e) => {
        const id = e.currentTarget.dataset.id;
        const sure = await Swal.fire({ title: 'Remove product?', icon: 'warning', showCancelButton: true });
        if (!sure.isConfirmed) return;
        const form = new FormData(); form.append('action','delete_product'); form.append('product_id', id);
        const resp = await fetchJSON('./API/admin.php', { method: 'POST', body: form });
        if (resp.success) loadProducts(); else Swal.fire('Error', resp.message || 'Delete failed', 'error');
    }));
}

function renderItems(){}

document.getElementById('addProductForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const form = new FormData(e.target);
    form.append('action', 'add_product');
    const data = await fetchJSON('./API/admin.php', { method: 'POST', body: form });
    if (data.success){
        e.target.reset();
        loadProducts();
    } else {
        Swal.fire('Error', data.message || 'Create failed', 'error');
    }
});

async function loadOrders(){
    const data = await fetchJSON('./API/admin.php?action=list_orders');
    if (!data.success) return Swal.fire('Error', data.message || 'Failed to load orders', 'error');
    const tbody = document.getElementById('ordersTable');
    tbody.innerHTML = data.orders.map(o => `
        <tr class="border-b">
            <td class="py-2">${o.order_number}</td>
            <td class="py-2">${formatCurrency(o.total_amount)}</td>
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
        const resp = await fetchJSON('./API/admin.php', { method: 'POST', body: form });
        if (!resp.success) Swal.fire('Error', resp.message || 'Update failed', 'error');
    }));
}

async function loadTransactions(){
    const s = document.getElementById('txStart').value;
    const e = document.getElementById('txEnd').value;
    const qs = new URLSearchParams({ action: 'transactions', date_start: s, date_end: e });
    const data = await fetchJSON('./API/admin.php?' + qs.toString());
    if (!data.success) return Swal.fire('Error', data.message || 'Failed to load transactions', 'error');
    const tbody = document.getElementById('txTable');
    tbody.innerHTML = (data.transactions||[]).map(t => `
        <tr class="border-b">
            <td class="py-2">${t.order_number}</td>
            <td class="py-2">${formatCurrency(t.total_amount)}</td>
            <td class="py-2">${formatCurrency(t.payment_amount)}</td>
            <td class="py-2">${formatCurrency(t.change_amount)}</td>
            <td class="py-2">${t.status}</td>
            <td class="py-2">${t.created_at}</td>
        </tr>
    `).join('');
    document.getElementById('txSum').textContent = formatCurrency(data.total_sum||0);
}

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
document.getElementById('txFilterBtn').addEventListener('click', loadTransactions);
document.getElementById('txPrintBtn').addEventListener('click', () => {
    const win = window.open('', '_blank');
    const html = `<!DOCTYPE html><html><head><title>Transactions Report</title><link rel="stylesheet" href="../styles.css"><style>table{width:100%;border-collapse:collapse}th,td{border:1px solid #eee;padding:6px}</style></head><body>` +
      document.getElementById('txTableWrapper').outerHTML + '</body></html>';
    win.document.write(html);
    win.document.close();
    win.focus();
    win.print();
});
document.getElementById('refreshOrdersBtn').addEventListener('click', loadOrders);
document.getElementById('refreshProductsBtn')?.addEventListener('click', loadProducts);

(async function init(){
    await loadProducts();
    await loadOrders();
    await loadTransactions();
})();