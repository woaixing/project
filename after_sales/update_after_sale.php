<?php
session_start();
require_once '../../db/db_connect.php';

if (!isset($_SESSION['employee_id'])) {
    echo json_encode(['success' => false, 'message' => '未授权访问']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$after_sale_id = $data['after_sale_id'];
$order_id = isset($data['order_id']) ? $data['order_id'] : null;
$feedback_issue = isset($data['feedback_issue']) ? $data['feedback_issue'] : null;
$issue_description = isset($data['issue_description']) ? $data['issue_description'] : null;
$feedback_date = isset($data['feedback_date']) ? $data['feedback_date'] : null;
$processing_date = isset($data['processing_date']) ? $data['processing_date'] : null;
$is_processed = isset($data['is_processed']) ? $data['is_processed'] : null;
$writer_id = isset($data['writer_id']) ? $data['writer_id'] : null;

$query = "UPDATE after_sales SET ";
$params = array();
$types = "";
if ($order_id) {
    $query .= "order_id=?, ";
    $params[] = $order_id;
    $types .= "i";
}
if ($feedback_issue) {
    $query .= "feedback_issue=?, ";
    $params[] = $feedback_issue;
    $types .= "s";
}
if ($issue_description) {
    $query .= "issue_description=?, ";
    $params[] = $issue_description;
    $types .= "s";
}
if ($feedback_date) {
    $query .= "feedback_date=?, ";
    $params[] = $feedback_date;
    $types .= "s";
}
if ($processing_date) {
    $query .= "processing_date=?, ";
    $params[] = $processing_date;
    $types .= "s";
}
if ($is_processed) {
    $query .= "is_processed=?, ";
    $params[] = $is_processed;
    $types .= "i";
}
if ($writer_id) {
    $query .= "writer_id=?, ";
    $params[] = $writer_id;
    $types .= "s";
}
$query = rtrim($query, ", "); // 去掉最后的逗号和空格
$query .= " WHERE after_sale_id=?";
$params[] = $after_sale_id;
$types .= "i";

$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => '售后记录更新成功']);
} else {
    echo json_encode(['success' => false, 'message' => '售后记录更新失败']);
}
?>