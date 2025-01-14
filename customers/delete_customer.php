<?php
session_start();
require_once '../../db/db_connect.php';

if (!isset($_SESSION['employee_id'])) {
    echo json_encode(['success' => false, 'message' => '未授权访问']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$customer_id = $data['customer_id'];

$stmt = $conn->prepare("DELETE FROM customers WHERE customer_id = ?");
$stmt->bind_param("i", $customer_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => '客户删除成功']);
} else {
    echo json_encode(['success' => false, 'message' => '客户删除失败']);
}
?>