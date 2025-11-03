<?php
// admin/API/admin.php
header('Content-Type: application/json');
require_once '../../config/database.php';
require_once '../../config/session.php';

$action = $_GET['action'] ?? $_POST['action'] ?? '';
$response = ['success' => false, 'message' => ''];

try {
    // Allow public actions for customers
    $publicActions = ['public_list_products', 'customer_submit_order'];
    if (!in_array($action, $publicActions, true)) {
        requireLogin();
        if (currentRole() !== 'admin' && currentRole() !== 'super_admin') {
            throw new Exception('Forbidden');
        }
    }

    $conn = getDBConnection();

    if ($action === 'list_products' || $action === 'public_list_products') {
        $rows = [];
        $res = $conn->query("SELECT product_id, name, price, image_url, status FROM products WHERE status='active' ORDER BY name");
        while ($row = $res->fetch_assoc()) {
            $rows[] = $row;
        }
        $response = ['success' => true, 'products' => $rows];
    }

    elseif ($action === 'add_product') {
        if (currentRole() !== 'admin' && currentRole() !== 'super_admin') throw new Exception('Forbidden');

        $name = trim($_POST['name'] ?? '');
        $price = floatval($_POST['price'] ?? 0);
        if ($name === '' || $price <= 0) throw new Exception('Invalid product');

        // Default image
        $imageToStore = 'https://via.placeholder.com/300x200?text=Toothy+Treats';

        if (!empty($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
            $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) throw new Exception('Upload error');
            if (!in_array($_FILES['image']['type'], $allowed, true)) throw new Exception('Invalid image type');

            $uploadDir = __DIR__ . '/../../uploads';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $safeName = 'prod_' . time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
            $destPath = $uploadDir . '/' . $safeName;
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $destPath)) {
                throw new Exception('Failed to move uploaded file');
            }
            $imageToStore = $safeName;
        } else {
            $imageText = trim($_POST['image_url'] ?? '');
            if ($imageText !== '') $imageToStore = $imageText;
        }

        $addedBy = (int)($_SESSION['user_id'] ?? 0);

        $hasAddedBy = $conn->query("SHOW COLUMNS FROM products LIKE 'added_by'")->num_rows === 1;
        if ($hasAddedBy) {
            $stmt = $conn->prepare('INSERT INTO products (name, price, image_url, status, added_by) VALUES (?, ?, ?, "active", ?)');
            $stmt->bind_param('sdsi', $name, $price, $imageToStore, $addedBy);
        } else {
            $stmt = $conn->prepare('INSERT INTO products (name, price, image_url, status) VALUES (?, ?, ?, "active")');
            $stmt->bind_param('sds', $name, $price, $imageToStore);
        }

        if (!$stmt->execute()) throw new Exception('Create failed: ' . $stmt->error);
        $response = ['success' => true, 'message' => 'Product added'];
    }

    elseif ($action === 'delete_product') {
        $productId = (int)($_POST['product_id'] ?? 0);
        if ($productId <= 0) throw new Exception('Invalid product');
        $stmt = $conn->prepare('UPDATE products SET status = "inactive" WHERE product_id = ?');
        $stmt->bind_param('i', $productId);
        if (!$stmt->execute() || $stmt->affected_rows === 0) throw new Exception('Delete failed');
        $response = ['success' => true, 'message' => 'Product removed'];
    }

    elseif ($action === 'create_order') {
        $itemsJson = $_POST['items'] ?? '[]';
        $items = json_decode($itemsJson, true);
        $total = floatval($_POST['total'] ?? 0);
        if (!is_array($items) || empty($items) || $total <= 0) throw new Exception('Invalid order');

        $conn->begin_transaction();
        try {
            $orderNumber = 'ORD-' . date('YmdHis') . '-' . rand(1000, 9999);
            $cashierId = (int)($_SESSION['user_id'] ?? null);
            $ins = $conn->prepare('INSERT INTO orders (order_number, total_amount, payment_amount, change_amount, status, cashier_id) VALUES (?, ?, 0, 0, "pending", ?)');
            $ins->bind_param('sdi', $orderNumber, $total, $cashierId);
            if (!$ins->execute()) throw new Exception('Order failed');
            $orderId = $conn->insert_id;

            $itemStmt = $conn->prepare('INSERT INTO order_items (order_id, product_id, quantity, unit_price, subtotal) VALUES (?, ?, ?, ?, ?)');
            foreach ($items as $it) {
                $pid = (int)$it['product_id'];
                $qty = (int)$it['quantity'];
                $price = (float)$it['unit_price'];
                $sub = $qty * $price;
                $itemStmt->bind_param('iiidd', $orderId, $pid, $qty, $price, $sub);
                $itemStmt->execute();
            }
            $conn->commit();
            $response = ['success' => true, 'message' => 'Order created', 'order_number' => $orderNumber];
        } catch (Exception $e) {
            $conn->rollback();
            throw $e;
        }
    }

    elseif ($action === 'list_orders') {
        $rows = [];
        $res = $conn->query('SELECT order_id, order_number, total_amount, status, created_at FROM orders ORDER BY created_at DESC');
        while ($row = $res->fetch_assoc()) {
            $rows[] = $row;
        }
        $response = ['success' => true, 'orders' => $rows];
    }

    elseif ($action === 'update_order_status') {
        $orderId = (int)($_POST['order_id'] ?? 0);
        $status = $_POST['status'] ?? '';
        $valid = ['pending', 'processing', 'completed', 'cancelled'];
        if (!in_array($status, $valid, true)) throw new Exception('Invalid status');
        $stmt = $conn->prepare('UPDATE orders SET status = ? WHERE order_id = ?');
        $stmt->bind_param('si', $status, $orderId);
        if (!$stmt->execute() || $stmt->affected_rows === 0) throw new Exception('No changes');
        $response = ['success' => true, 'message' => 'Status updated'];
    }

    elseif ($action === 'transactions') {
        $dateStart = trim($_GET['date_start'] ?? '');
        $dateEnd = trim($_GET['date_end'] ?? '');
        $params = [];
        $where = '';
        if ($dateStart !== '' && $dateEnd !== '') {
            $where = 'WHERE DATE(created_at) BETWEEN ? AND ?';
            $params = [$dateStart, $dateEnd];
        } elseif ($dateStart !== '') {
            $where = 'WHERE DATE(created_at) >= ?';
            $params = [$dateStart];
        } elseif ($dateEnd !== '') {
            $where = 'WHERE DATE(created_at) <= ?';
            $params = [$dateEnd];
        }

        $sql = "SELECT order_id, order_number, total_amount, payment_amount, change_amount, status, created_at FROM orders $where ORDER BY created_at DESC";
        if (!empty($params)) {
            $types = str_repeat('s', count($params));
            $stmt = $conn->prepare($sql);
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            $res = $stmt->get_result();
        } else {
            $res = $conn->query($sql);
        }

        $rows = [];
        $totalSum = 0.0;
        while ($row = $res->fetch_assoc()) {
            $rows[] = $row;
            $totalSum += (float)$row['total_amount'];
        }
        $response = ['success' => true, 'transactions' => $rows, 'total_sum' => $totalSum];
    }

    // ✅ Properly placed fetch_order_items block
    elseif ($action === 'fetch_order_items') {
        $orderId = (int)($_GET['order_id'] ?? 0);
        if ($orderId <= 0) throw new Exception('Invalid order ID');

        $stmt = $conn->prepare('
            SELECT 
                p.name AS product_name, 
                oi.quantity, 
                oi.unit_price AS price, 
                (oi.quantity * oi.unit_price) AS total
            FROM order_items oi
            JOIN products p ON oi.product_id = p.product_id
            WHERE oi.order_id = ?
        ');
        $stmt->bind_param('i', $orderId);
        $stmt->execute();
        $res = $stmt->get_result();

        $items = [];
        while ($row = $res->fetch_assoc()) {
            $items[] = $row;
        }

        $response = ['success' => true, 'items' => $items];
    }

    elseif ($action === 'customer_submit_order') {
        $itemsJson = $_POST['items'] ?? '[]';
        $items = json_decode($itemsJson, true);
        $customerName = trim($_POST['customer_name'] ?? 'Customer');
        $phone = trim($_POST['phone'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $total = floatval($_POST['total'] ?? 0);
        $payment = floatval($_POST['payment'] ?? 0);
        if (!is_array($items) || empty($items)) throw new Exception('No items');
        if ($total <= 0) throw new Exception('Invalid total');
        if ($payment < $total) throw new Exception('Insufficient payment');

        $conn->begin_transaction();
        try {
            $orderNumber = 'ORD-' . date('YmdHis') . '-' . rand(1000, 9999);
            $changeAmount = $payment - $total;
            $ins = $conn->prepare('INSERT INTO orders (order_number, customer_name, phone, address, total_amount, payment_amount, change_amount, status) VALUES (?, ?, ?, ?, ?, ?, ?, "pending")');
            $ins->bind_param('ssssddd', $orderNumber, $customerName, $phone, $address, $total, $payment, $changeAmount);
            if (!$ins->execute()) throw new Exception('Order failed');
            $orderId = $conn->insert_id;

            $itemStmt = $conn->prepare('INSERT INTO order_items (order_id, product_id, quantity, unit_price, subtotal) VALUES (?, ?, ?, ?, ?)');
            foreach ($items as $it) {
                $pid = (int)$it['product_id'];
                $qty = (int)$it['quantity'];
                $price = (float)$it['unit_price'];
                $sub = $qty * $price;
                $itemStmt->bind_param('iiidd', $orderId, $pid, $qty, $price, $sub);
                $itemStmt->execute();
            }
            $conn->commit();
            $response = ['success' => true, 'order_number' => $orderNumber, 'change' => $changeAmount];
        } catch (Exception $e) {
            $conn->rollback();
            throw $e;
        }
    }

    else {
        throw new Exception('Invalid action');
    }

} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = $e->getMessage();
} finally {
    if (isset($conn)) closeDBConnection($conn);
}

echo json_encode($response);
