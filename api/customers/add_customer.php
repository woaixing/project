<?php
session_start();
require_once '../../db/db_connect.php';

if (!isset($_SESSION['employee_id'])) {
    echo json_encode(['success' => false, 'message' => '未授权访问']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$customer_name = $data['customer_name'];
$customer_type = $data['customer_type'];
$contact_info = isset($data['contact_info']) ? $data['contact_info'] : null; // 联系方式非必填
$added_by = $data['added_by'];
$operator = $data['operator'];

$stmt = $conn->prepare("INSERT INTO customers (customer_name, customer_type, contact_info, added_by, operator) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssii", $customer_name, $customer_type, $contact_info, $added_by, $operator);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => '客户添加成功']);
} else {
    echo json_encode(['success' => false, 'message' => '客户添加失败']);
}
?>