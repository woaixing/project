<?php
session_start();
require_once '../../db/db_connect.php';

if (!isset($_SESSION['employee_id'])) {
    echo json_encode(['success' => false, 'message' => '未授权访问']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$order_id = $data['order_id'];
$order_number = isset($data['order_number']) ? $data['order_number'] : null;
$customer_id = isset($data['customer_id']) ? $data['customer_id'] : null;
$received_date = isset($data['received_date']) ? $data['received_date'] : null;
$delivery_date = isset($data['delivery_date']) ? $data['delivery_date'] : null;
$total_amount = isset($data['total_amount']) ? $data['total_amount'] : null;
$actual_payment = isset($data['actual_payment']) ? $data['actual_payment'] : null;
$sales_department = isset($data['sales_department']) ? $data['sales_department'] : null;
$major = isset($data['major']) ? $data['major'] : null;
$title = isset($data['title']) ? $data['title'] : null;
$word_count = isset($data['word_count']) ? $data['word_count'] : null;
$requirements = isset($data['requirements']) ? $data['requirements'] : null;
$transaction_status = isset($data['transaction_status']) ? $data['transaction_status'] : null;
$order_status = isset($data['order_status']) ? $data['order_status'] : null;
$writer_status = isset($data['writer_status']) ? $data['writer_status'] : null;
$sales_status = isset($data['sales_status']) ? $data['sales_status'] : null;
$payment_shop = isset($data['payment_shop']) ? $data['payment_shop'] : null;
$notes = isset($data['notes']) ? $data['notes'] : null;
$writer_id = isset($data['writer_id']) ? $data['writer_id'] : null;

$query = "UPDATE orders SET ";
$params = array();
$types = "";
if ($order_number) {
    $query .= "order_number=?, ";
    $params[] = $order_number;
    $types .= "s";
}
if ($customer_id) {
    $query .= "customer_id=?, ";
    $params[] = $customer_id;
    $types .= "i";
}
if ($received_date) {
    $query .= "received_date=?, ";
    $params[] = $received_date;
    $types .= "s";
}
if ($delivery_date) {
    $query .= "delivery_date=?, ";
    $params[] = $delivery_date;
    $types .= "s";
}
if ($total_amount) {
    $query .= "total_amount=?, ";
    $params[] = $total_amount;
    $types .= "d";
}
if ($actual_payment) {
    $query .= "actual_payment=?, ";
    $params[] = $actual_payment;
    $types .= "d";
}
if ($sales_department) {
    $query .= "sales_department=?, ";
    $params[] = $sales_department;
    $types .= "s";
}
if ($major) {
    $query .= "major=?, ";
    $params[] = $major;
    $types .= "s";
}
if ($title) {
    $query .= "title=?, ";
    $params[] = $title;
    $types .= "s";
}
if ($word_count) {
    $query .= "word_count=?, ";
    $params[] = $word_count;
    $types .= "i";
}
if ($requirements) {
    $query .= "requirements=?, ";
    $params[] = $requirements;
    $types .= "s";
}
if ($transaction_status) {
    $query .= "transaction_status=?, ";
    $params[] = $transaction_status;
    $types .= "s";
}
if ($order_status) {
    $query .= "order_status=?, ";
    $params[] = $order_status;
    $types .= "s";
}
if ($writer_status) {
    $query .= "writer_status=?, ";
    $params[] = $writer_status;
    $types .= "s";
}
if ($sales_status) {
    $query .= "sales_status=?, ";
    $params[] = $sales_status;
    $types .= "s";
}
if ($payment_shop) {
    $query .= "payment_shop=?, ";
    $params[] = $payment_shop;
    $types .= "s";
}
if ($notes) {
    $query .= "notes=?, ";
    $params[] = $notes;
    $types .= "s";
}
if ($writer_id) {
    $query .= "writer_id=?, ";
    $params[] = $writer_id;
    $types .= "s";
}
$query = rtrim($query, ", "); // 去掉最后的逗号和空格
$query .= " WHERE order_id=?";
$params[] = $order_id;
$types .= "i";

$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => '订单信息更新成功']);
} else {
    echo json_encode(['success' => false, 'message' => '订单信息更新失败']);
}
?>