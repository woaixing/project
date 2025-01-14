<?php
session_start();
require_once '../../db/db_connect.php';

if (!isset($_SESSION['employee_id']) || $_SESSION['role_id'] != 1) {
    echo json_encode(['success' => false, 'message' => '未授权访问']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$employee_id = $data['employee_id'];

$stmt = $conn->prepare("DELETE FROM employees WHERE employee_id = ?");
$stmt->bind_param("i", $employee_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => '员工删除成功']);
} else {
    echo json_encode(['success' => false, 'message' => '员工删除失败']);
}
?>