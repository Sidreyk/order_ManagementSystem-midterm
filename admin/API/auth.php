<?php
// admin/API/auth.php
header('Content-Type: application/json');
require_once '../../config/database.php';
require_once '../../config/session.php';

$action = $_GET['action'] ?? $_POST['action'] ?? '';
$response = ['success' => false, 'message' => ''];

try {
    if ($action === 'login') {
        $conn = getDBConnection();
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        if ($username === '' || $password === '') throw new Exception('Username and password required');

        $stmt = $conn->prepare("SELECT user_id, username, email, password, role, status FROM users WHERE username = ? AND role = 'admin' AND status = 'active'");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows !== 1) throw new Exception('Invalid credentials');
        $user = $res->fetch_assoc();
        if (!password_verify($password, $user['password'])) throw new Exception('Invalid credentials');
        loginUser((int)$user['user_id'], $user['username'], $user['email'], $user['role']);
        $response = ['success' => true, 'message' => 'Logged in', 'role' => $user['role']];
        $stmt->close();
        closeDBConnection($conn);
    } elseif ($action === 'logout') {
        logoutUser();
        $response = ['success' => true, 'message' => 'Logged out'];
    } else {
        throw new Exception('Invalid action');
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
