<?php
require_once '../config/session.php';
requireAdmin(); // ensures only admin can access

$username = htmlspecialchars($_SESSION['user']['username'] ?? 'Admin');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - POS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>body{font-family:'Poppins',sans-serif}</style>
    <script>
      function toggleMobileMenu(){
        const el = document.getElementById('mobile-menu');
        if (el) el.classList.toggle('hidden');
      }
    </script>
    
</head>
<body class="bg-gradient-to-br from-pink-100 to-blue-100 min-h-screen">
    <nav class="candy-gradient shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="#" class="text-2xl font-bold text-white">Toothy Treats</a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-center space-x-8">
                        <button id="logoutBtn" class="bg-white text-pink-700 px-3 py-1 rounded text-sm">Logout</button>
                    </div>
                </div>
                <div class="md:hidden">
                    <button type="button" onclick="toggleMobileMenu()" class="text-white hover:text-pink-200 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
            <div id="mobile-menu" class="hidden md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <button id="logoutBtnMobile" class="w-full text-left bg-white bg-opacity-20 hover:bg-opacity-30 px-3 py-2 rounded text-white">Logout</button>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-8 flex flex-col gap-8">
        <h1 class="text-2xl font-semibold text-gray-800">
            Hello, <?php echo $username; ?>! Welcome to the Admin Dashboard.
        </h1>

    <!-- PRODUCTS SECTION -->
    <section class="bg-white rounded-lg shadow p-6 w-full">
        <div class="flex items-center justify-between border-b pb-4 mb-4">
            <h2 class="text-lg font-semibold tracking-wide">Products</h2>
            <button id="refreshProductsBtn" class="btn-primary text-sm px-4 py-2">Refresh</button>
        </div>

        <form id="addProductForm" class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6 w-full">
            <input name="name" placeholder="Name" class="form-input md:col-span-2 w-full h-10" required>
            <input name="price" type="number" step="0.01" placeholder="Price (₱)" class="form-input md:col-span-1 w-full h-10" required>
            <input name="image_url" placeholder="Image URL (optional)" class="form-input md:col-span-2 w-full h-10">
            <button class="btn-primary text-sm px-4 py-2 h-10 w-full md:w-auto md:col-span-1">Add</button>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-gray-50">
                    <tr class="text-left border-b">
                        <th class="py-3 px-3 font-medium">Name</th>
                        <th class="py-3 px-3 font-medium">Price</th>
                        <th class="py-3 px-3 font-medium">Status</th>
                        <th class="py-3 px-3 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody id="productsTable" class="divide-y"></tbody>
            </table>
        </div>
    </section>

    <!-- ORDERS SECTION -->
    <section class="bg-white rounded-lg shadow p-6 w-full">
        <div class="flex items-center justify-between border-b pb-4 mb-4">
            <h2 class="text-lg font-semibold tracking-wide">Orders</h2>
            <button id="refreshOrdersBtn" class="btn-primary text-sm px-4 py-2">Refresh</button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-gray-50">
                    <tr class="text-left border-b">
                        <th class="py-3 px-3 font-medium">Order #</th>
                        <th class="py-3 px-3 font-medium">Total</th>
                        <th class="py-3 px-3 font-medium">Status</th>
                        <th class="py-3 px-3 font-medium">Created</th>
                        <th class="py-3 px-3 font-medium">Action</th>
                    </tr>
                </thead>
                <tbody id="ordersTable" class="divide-y"></tbody>
            </table>
        </div>
    </section>

    <!-- TRANSACTIONS HISTORY SECTION -->
    <section class="bg-white rounded-lg shadow p-6 w-full">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b pb-4 mb-4">
            <h2 class="text-lg font-semibold tracking-wide">Transactions History</h2>
            <div class="flex flex-wrap gap-2 items-center text-sm mt-3 md:mt-0">
                <input type="date" id="txStart" class="form-input w-36 h-10">
                <input type="date" id="txEnd" class="form-input w-36 h-10">
                <button id="txFilterBtn" class="btn-primary text-sm px-4 py-2 h-10">Filter</button>
                <button id="txPrintBtn" class="btn-primary text-sm px-4 py-2 h-10">Print</button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse" id="txTableWrapper">
                <thead class="bg-gray-50">
                    <tr class="text-left border-b">
                        <th class="py-3 px-3 font-medium">Order #</th>
                        <th class="py-3 px-3 font-medium">Total</th>
                        <th class="py-3 px-3 font-medium">Payment</th>
                        <th class="py-3 px-3 font-medium">Change</th>
                        <th class="py-3 px-3 font-medium">Status</th>
                        <th class="py-3 px-3 font-medium">Created</th>
                    </tr>
                </thead>
                <tbody id="txTable" class="divide-y"></tbody>
                <tfoot>
                    <tr class="border-t font-semibold bg-gray-50">
                        <td class="py-3 px-3">Total</td>
                        <td class="py-3 px-3" id="txSum">₱0.00</td>
                        <td class="py-3 px-3"></td>
                        <td class="py-3 px-3"></td>
                        <td class="py-3 px-3"></td>
                        <td class="py-3 px-3"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </section>

</main>

    <script src="scripts/script.js"></script>
</body>
</html>
