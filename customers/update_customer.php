<?php
session_start();
require_once '../../db/db_connect.php';

if (!isset($_SESSION['employee_id'])) {
    echo json_encode(['success' => false, 'message' => '未授权访问']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$customer_id = $data['customer_id'];
$customer_name = isset($data['customer_name']) ? $data['customer_name'] : null;
$customer_type = isset($data['customer_type']) ? $data['customer_type'] : null;
$contact_info = isset($data['contact_info']) ? $data['contact_info'] : null;
$added_by = isset($data['added_by']) ? $data['added_by'] : null;
$operator = isset($data['operator']) ? $data['operator'] : null;

$query = "UPDATE customers SET ";
$params = array();
$types = "";
if ($customer_name) {
    $query .= "customer_name=?, ";
    $params[] = $customer_name;
    $types .= "s";
}
if ($customer_type) {
    $query .= "customer_type=?, ";
    $params[] = $customer_type;
    $types .= "s";
}
if ($contact_info) {
    $query .= "contact_info=?, ";
    $params[] = $contact_info;
    $types .= "s";
}
if ($added_by) {
    $query .= "added_by=?, ";
    $params[] = $added_by;
    $types .= "i";
}
if ($operator) {
    $query .= "operator=?, ";
    $params[] = $operator;
    $types .= "i";
}
$query = rtrim($query, ", "); // 去掉最后的逗号和空格
$query .= " WHERE customer_id=?";
$params[] = $customer_id;
$types .= "i";

$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => '客户信息更新成功']);
} else {
    echo json_encode(['success' => false, 'message' => '客户信息更新失败']);
}
?>