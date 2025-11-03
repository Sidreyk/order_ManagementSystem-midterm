<?php
require_once '../config/session.php';
requireSuperAdmin(); // ensures only superadmin can access

$username = htmlspecialchars($_SESSION['user']['username'] ?? 'Superadmin');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
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

    <main class="max-w-7xl mx-auto px-4 py-8 grid md:grid-cols-2 gap-6">
        
        <h1 class="text-2xl font-semibold text-gray-800">
            Hello, <?php echo $username; ?>! Welcome to the Super Admin Dashboard.
        </h1>

        <section class="bg-white rounded-lg shadow p-6 md:col-span-2">
            <h2 class="text-lg font-semibold mb-3">Create Admin</h2>
            <form id="createAdminForm" class="grid grid-cols-1 gap-3">
                <input name="username" placeholder="Username" class="form-input" required>
                <input name="email" type="email" placeholder="Email" class="form-input" required>
                <input name="password" type="password" placeholder="Password (min 6)" class="form-input" required>
                <button class="btn-primary">Create Admin</button>
            </form>
        </section>

        <section class="bg-white rounded-lg shadow p-6 md:col-span-2">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-lg font-semibold">Users</h2>
                <button id="refreshBtn" class="text-sm btn-primary">Refresh</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left border-b">
                            <th class="py-2">Username</th>
                            <th class="py-2">Email</th>
                            <th class="py-2">Role</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="usersTable"></tbody>
                </table>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow p-6 md:col-span-2">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-lg font-semibold">Products</h2>
            </div>

        <form id="createProductForm" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-5 gap-2 mb-4 items-center">
            <input name="name" placeholder="Name" class="form-input md:col-span-2" required>
            <input name="price" type="number" step="0.01" placeholder="Price" class="form-input md:col-span-1" required>
            <input name="image" type="file" accept="image/*" class="form-input md:col-span-2" required>

            <!-- Buttons row -->
            <div class="flex justify-between md:col-span-5 mt-2">
                <button id="refreshProductsBtn" type="button" class="btn-primary text-sm px-4 py-2 bg-gray-500 hover:bg-gray-600">Refresh</button>
                <button class="btn-primary text-sm px-4 py-2">Add</button>
            </div>
        </form>


            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                <thead>
                    <tr class="text-left border-b">
                        <th class="py-2">Image</th>
                        <th class="py-2">Name</th>
                        <th class="py-2">Price</th>
                        <th class="py-2">Status</th>
                        <th class="py-2">Actions</th>
                    </tr>
                </thead>
                    <tbody id="productsTable"></tbody>
                </table>
            </div>
        </section>



        <section class="bg-white rounded-lg shadow p-6 md:col-span-2">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-lg font-semibold">Orders (view/manage)</h2>
                <button id="refreshOrdersBtn" class="text-sm btn-primary">Refresh</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left border-b">
                            <th class="py-2">Order #</th>
                            <th class="py-2">Total</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Created</th>
                            <th class="py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody id="ordersTable"></tbody>
                </table>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow p-6 md:col-span-2">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-lg font-semibold">Transactions History</h2>
                <div class="flex gap-2 items-center text-sm">
                    <input type="date" id="txStart" class="form-input">
                    <input type="date" id="txEnd" class="form-input">
                    <button id="txFilterBtn" class="btn-primary">Filter</button>
                    <button id="txPrintBtn" class="btn-primary">Print</button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm" id="txTableWrapper">
                    <thead>
                        <tr class="text-left border-b">
                            <th class="py-2">Order #</th>
                            <th class="py-2">Total</th>
                            <th class="py-2">Payment</th>
                            <th class="py-2">Change</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Created</th>
                            <th class="py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody id="txTable"></tbody>
                    <tfoot>
                        <tr class="border-t font-semibold">
                            <td class="py-2">Total</td>
                            <td class="py-2" id="txSum">₱0.00</td>
                            <td class="py-2"></td>
                            <td class="py-2"></td>
                            <td class="py-2"></td>
                            <td class="py-2"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </section>
    </main>

    <script src="scripts/script.js"></script>
</body>
</html>
