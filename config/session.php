<?php
// config/session.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function loginUser(int $userId, string $username, string $email, string $role): void {
    $_SESSION['user_id'] = $userId;
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['role'] = $role;
}

function logoutUser(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_unset();
    session_destroy();
}

function isLoggedIn(): bool {
    return isset($_SESSION['user_id']);
}

function currentRole(): ?string {
    return $_SESSION['role'] ?? null;
}

function requireLogin(): void {
    if (!isLoggedIn()) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
        exit();
    }
}

function requireSuperAdmin(): void {
    requireLogin();
    if (currentRole() !== 'super_admin') {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Forbidden']);
        exit();
    }
}

function requireAdmin(): void {
    requireLogin();
    $role = currentRole();
    if ($role !== 'admin' && $role !== 'super_admin') {
        header('Location: ../login.php');
        exit;
    }
}
