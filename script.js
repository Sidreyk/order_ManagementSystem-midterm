// Product data (loaded from backend)
let products = [];

async function loadProductsAndRender() {
    try {
        const res = await fetch('admin/API/admin.php?action=public_list_products');
        const data = await res.json();
        if (!data.success) throw new Error(data.message || 'Failed to load products');
        products = (data.products || []).map(p => ({ 
        id: Number(p.product_id), 
        name: p.name, 
        price: Number(p.price), 
        image: `uploads/${p.image_url || p.image || ''}` // ✅ fix: add full path
    }));

        // Initialize default quantity for each
        initializeQuantities();
        const container = document.getElementById('dynamic-products');
        if (container) {
            container.innerHTML = products.map(p => `
                <div class="bg-white p-6 rounded-lg shadow-lg product-card">
                    <img src="${p.image}" alt="${p.name}" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-semibold text-pink-600 mb-2">${p.name}</h3>
                    <span class="text-2xl font-bold text-pink-600 block mb-4">₱${p.price.toFixed(2)}</span>
                    <div class="flex items-center space-x-2">
                        <input type="number" id="quantity-${p.id}" value="1" min="1" class="w-16 px-2 py-1 border rounded-lg focus:border-pink-500 focus:ring-pink-500" onchange="updateQuantityDisplay(${p.id})">
                        <button onclick="addToOrder(${p.id})" class="bg-pink-600 text-white px-4 py-2 rounded-lg hover:bg-pink-700 transition duration-300">Add to Order</button>
                    </div>
                </div>
            `).join('');
        }
    } catch (err) {
        console.error(err);
        Swal && Swal.fire && Swal.fire('Error', err.message || 'Failed to load products', 'error');
    }
}

// Order management
let order = [];
let productQuantities = {};

// Initialize product quantities
function initializeQuantities() {
    products.forEach(product => {
        productQuantities[product.id] = 1;
    });
}

// Update quantity display
function updateQuantityDisplay(productId) {
    const quantityInput = document.getElementById(`quantity-${productId}`);
    if (quantityInput) {
        const newQuantity = parseInt(quantityInput.value);
        if (newQuantity >= 1) {
            productQuantities[productId] = newQuantity;
        } else {
            quantityInput.value = 1;
            productQuantities[productId] = 1;
        }
    }
}

// Add product to order
function addToOrder(productId) {
    const product = products.find(p => p.id === productId);
    if (!product) return;

    const quantity = productQuantities[productId];
    const existingItem = order.find(item => item.id === productId);
    if (existingItem) {
        existingItem.quantity += quantity;
    } else {
        order.push({
            id: product.id,
            name: product.name,
            price: product.price,
            quantity: quantity
        });
    }

    // Reset quantity after adding to order
    productQuantities[productId] = 1;
    const quantityInput = document.getElementById(`quantity-${productId}`);
    if (quantityInput) {
        quantityInput.value = 1;
    }
    updateOrderDisplay();

    Swal.fire({
        title: "Added to Order",
        text: `${product.name} × ${quantity} added successfully.`,
        icon: "success",
        confirmButtonColor: "#ec4899"
    });
}

// Update order display
function updateOrderDisplay() {
    const orderItemsContainer = document.getElementById('order-items');
    const orderTotalElement = document.getElementById('order-total');
    
    orderItemsContainer.innerHTML = '';
    let total = 0;

    order.forEach(item => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;

        const itemElement = document.createElement('div');
        itemElement.className = 'flex justify-between items-center';
        itemElement.innerHTML = `
            <div>
                <span class="font-semibold">${item.name}</span>
                <div class="text-sm text-gray-600">
                    <span>₱${item.price.toFixed(2)} × ${item.quantity}</span>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <button onclick="updateOrderQuantity(${item.id}, ${item.quantity - 1})" class="text-pink-600 hover:text-pink-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                </button>
                <span>${item.quantity}</span>
                <button onclick="updateOrderQuantity(${item.id}, ${item.quantity + 1})" class="text-pink-600 hover:text-pink-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                </button>
                <button onclick="removeFromOrder(${item.id})" class="text-red-600 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        `;
        orderItemsContainer.appendChild(itemElement);
    });

    orderTotalElement.textContent = `₱${total.toFixed(2)}`;
}

// Update quantity of an item in the order
function updateOrderQuantity(productId, newQuantity) {
    if (newQuantity < 1) {
        removeFromOrder(productId);
        return;
    }

    const item = order.find(item => item.id === productId);
    if (item) {
        item.quantity = newQuantity;
        updateOrderDisplay();
    }
}

// Remove item from order
function removeFromOrder(productId) {
    Swal.fire({
        title: "Remove Item?",
        text: "Are you sure you want to remove this product from your order?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc2626",
        cancelButtonColor: "#6b7280",
        confirmButtonText: "Yes, remove it"
    }).then((result) => {
        if (result.isConfirmed) {
            order = order.filter(item => item.id !== productId);
            updateOrderDisplay();
            Swal.fire("Removed!", "The product has been removed.", "success");
        }
    });
}

// Process payment - submit to backend and wait for admin approval
async function processPayment() {
    const paymentInput = document.getElementById('payment');
    const paymentAmount = parseFloat(paymentInput.value);
    const total = order.reduce((sum, item) => sum + (item.price * item.quantity), 0);

    if (order.length === 0) {
        Swal.fire("Empty Order", "Please add items to your order first.", "warning");
        return;
    }

    if (isNaN(paymentAmount) || paymentAmount <= 0) {
        Swal.fire("Invalid Payment", "Please enter a valid payment amount.", "error");
        return;
    }

    if (paymentAmount < total) {
        const remaining = total - paymentAmount;
        Swal.fire("Insufficient Payment", `You still need ₱${remaining.toFixed(2)}.`, "error");
        return;
    }

    const itemsPayload = order.map(it => ({
        product_id: it.id,
        quantity: it.quantity,
        unit_price: it.price
    }));

    const form = new FormData();
    form.append('action', 'customer_submit_order');
    form.append('items', JSON.stringify(itemsPayload));
    form.append('total', String(total));
    form.append('payment', String(paymentAmount));
    // optional customer info fields could be added later

    try {
        const res = await fetch('admin/API/admin.php', { method: 'POST', body: form });
        const data = await res.json();
        if (!data.success) throw new Error(data.message || 'Order failed');
        const change = paymentAmount - total;
        await Swal.fire({
            title: 'Order Submitted',
            text: `Your order ${data.order_number} is pending approval. Change: ₱${change.toFixed(2)}.`,
            icon: 'success',
            confirmButtonColor: '#ec4899'
        });
        order = [];
        updateOrderDisplay();
        paymentInput.value = '';
    } catch (err) {
        Swal.fire('Error', err.message || 'Failed to submit order', 'error');
    }
}

// Initialize the page
document.addEventListener('DOMContentLoaded', () => {
    updateOrderDisplay();
    // Load products dynamically if products page container is present
    if (document.getElementById('dynamic-products')) {
        loadProductsAndRender();
    } else {
        // For pages without dynamic grid, still ensure quantities exist for any referenced IDs
        initializeQuantities();
    }
});
