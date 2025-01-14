<?php
session_start();
require_once '../../db/db_connect.php';

if (!isset($_SESSION['employee_id'])) {
    echo json_encode(['success' => false, 'message' => '未授权访问']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$order_id = $data['order_id'];
$feedback_issue = $data['feedback_issue'];
$issue_description = $data['issue_description'];
$feedback_date = $data['feedback_date'];
$processing_date = $data['processing_date'];
$is_processed = $data['is_processed'];
$writer_id = $data['writer_id'];

$stmt = $conn->prepare("INSERT INTO after_sales (order_id, feedback_issue, issue_description, feedback_date, processing_date, is_processed, writer_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssis", $order_id, $feedback_issue, $issue_description, $feedback_date, $processing_date, $is_processed, $writer_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => '售后记录添加成功']);
} else {
    echo json_encode(['success' => false, 'message' => '售后记录添加失败']);
}
?>