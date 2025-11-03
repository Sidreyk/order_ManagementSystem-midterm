<?php
// superadmin/API/auth.php
header('Content-Type: application/json');
require_once '../../config/database.php';
require_once '../../config/session.php';

$action = $_GET['action'] ?? $_POST['action'] ?? '';
$response = ['success' => false, 'message' => ''];

try {
    $conn = getDBConnection();

    if ($action === 'login') {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
            if ($username === '' || $password === '') throw new Exception('Username and password required');

            $stmt = $conn->prepare("SELECT user_id, username, email, password, role, status FROM users WHERE username = ? AND role = 'super_admin' AND status = 'active'");
                $stmt->bind_param('s', $username);
                $stmt->execute();
                $res = $stmt->get_result();

        if ($res->num_rows !== 1) throw new Exception('Invalid credentials');
            $user = $res->fetch_assoc();
                if (!password_verify($password, $user['password'])) throw new Exception('Invalid credentials');
                    loginUser((int)$user['user_id'], $user['username'], $user['email'], $user['role']);
                    $response = ['success' => true, 'message' => 'Logged in', 'role' => $user['role']];
                    $stmt->close();
            } elseif ($action === 'logout') {
                logoutUser();
                    $response = ['success' => true, 'message' => 'Logged out'];
            } elseif ($action === 'create_admin') {
                requireSuperAdmin();
                $username = trim($_POST['username'] ?? '');
                $email = trim($_POST['email'] ?? '');
                $password = trim($_POST['password'] ?? '');
        if ($username === '' || $email === '' || $password === '') throw new Exception('All fields required');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) throw new Exception('Invalid email');

        if (strlen($password) < 6) throw new Exception('Password too short');
            $check = $conn->prepare('SELECT user_id FROM users WHERE username = ? OR email = ?');
            $check->bind_param('ss', $username, $email);
            $check->execute();

        if ($check->get_result()->num_rows > 0) throw new Exception('Username or email already exists');
            $check->close();

            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $creatorId = (int)($_SESSION['user_id'] ?? 0);
            $ins = $conn->prepare('INSERT INTO users (username, email, password, role, status, created_by) VALUES (?, ?, ?, "admin", "active", ?)');
            $ins->bind_param('sssi', $username, $email, $hashed, $creatorId);

        if (!$ins->execute()) throw new Exception('Failed to create user');
            $ins->close();
            $response = ['success' => true, 'message' => 'Admin created'];
            } elseif ($action === 'toggle_status') {
                requireSuperAdmin();
                $userId = (int)($_POST['user_id'] ?? 0);
                $new = $_POST['status'] === 'suspended' ? 'suspended' : 'active';

        if ($userId <= 0) throw new Exception('Invalid user');

        // prevent modifying super_admin accounts
            $chk = $conn->prepare('SELECT role FROM users WHERE user_id = ?');
            $chk->bind_param('i', $userId);
            $chk->execute();
            $roleRow = $chk->get_result()->fetch_assoc();

        if (!$roleRow) throw new Exception('User not found');

        if ($roleRow['role'] === 'super_admin') throw new Exception('Cannot modify Super Admin');
            $stmt = $conn->prepare('UPDATE users SET status = ? WHERE user_id = ?');
            $stmt->bind_param('si', $new, $userId);

        if (!$stmt->execute() || $stmt->affected_rows === 0) throw new Exception('No changes');
            $stmt->close();
            $response = ['success' => true, 'message' => 'Status updated'];
            } elseif ($action === 'delete_user') {
                requireSuperAdmin();
                $userId = (int)($_POST['user_id'] ?? 0);

        if ($userId <= 0) throw new Exception('Invalid user');
            $chk = $conn->prepare('SELECT role FROM users WHERE user_id = ?');
            $chk->bind_param('i', $userId);
            $chk->execute();
            $roleRow = $chk->get_result()->fetch_assoc();

        if (!$roleRow) throw new Exception('User not found');

        if ($roleRow['role'] === 'super_admin') throw new Exception('Cannot delete Super Admin');

            $del = $conn->prepare('DELETE FROM users WHERE user_id = ?');
            $del->bind_param('i', $userId);
            if (!$del->execute() || $del->affected_rows === 0) throw new Exception('Delete failed');
            $del->close();
            $response = ['success' => true, 'message' => 'User deleted'];
                } elseif ($action === 'list_users') {
            requireSuperAdmin();
                    $rows = [];
                    $res = $conn->query('SELECT user_id, username, email, role, status, created_at FROM users ORDER BY created_at DESC');
                while ($row = $res->fetch_assoc()) { $rows[] = $row; }
        $response = ['success' => true, 'users' => $rows];
    } else {
        throw new Exception('Invalid action');
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = $e->getMessage();
} finally {
    if (isset($conn)) closeDBConnection($conn);
}

echo json_encode($response);
