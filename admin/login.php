<?php
// Admin Login Page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-xl shadow p-6">
        <h1 class="text-2xl font-bold mb-4">Admin Login</h1>
        <form id="loginForm" class="space-y-4">
            <input type="text" name="username" placeholder="Username" class="w-full border p-2 rounded" required>
            <input type="password" name="password" placeholder="Password" class="w-full border p-2 rounded" required>
            <button class="w-full bg-blue-600 text-white py-2 rounded">Login</button>
        </form>
        <p class="text-sm text-gray-500 mt-4">For Super Admin, go to /superadmin/login.php</p>
    </div>
    <script>
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            formData.append('action', 'login');
            const res = await fetch('../admin/API/auth.php', { method: 'POST', body: formData });
            const data = await res.json();
            if (data.success) {
                location.href = './dashboard.php';
            } else {
                Swal.fire('Error', data.message || 'Login failed', 'error');
            }
        });
    </script>
</body>
</html>
