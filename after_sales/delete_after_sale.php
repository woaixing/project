<?php
session_start();
require_once '../../db/db_connect.php';

if (!isset($_SESSION['employee_id'])) {
    echo json_encode(['success' => false, 'message' => '未授权访问']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$after_sale_id = $data['after_sale_id'];

$stmt = $conn->prepare("DELETE FROM after_sales WHERE after_sale_id = ?");
$stmt->bind_param("i", $after_sale_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => '售后记录删除成功']);
} else {
    echo json_encode(['success' => false, 'message' => '售后记录删除失败']);
}
?>