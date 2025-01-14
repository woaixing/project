<?php
session_start();
require_once '../../db/db_connect.php';

if (!isset($_SESSION['employee_id'])) {
    echo json_encode(['success' => false, 'message' => '未授权访问']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$order_number = $data['order_number'];
$customer_id = $data['customer_id'];
$received_date = $data['received_date'];
$delivery_date = $data['delivery_date'];
$total_amount = $data['total_amount'];
$actual_payment = $data['actual_payment'];
$sales_department = $data['sales_department'];
$major = $data['major'];
$title = $data['title'];
$word_count = $data['word_count'];
$requirements = $data['requirements'];
$transaction_status = $data['transaction_status'];
$order_status = $data['order_status'];
$writer_status = $data['writer_status'];
$sales_status = $data['sales_status'];
$payment_shop = $data['payment_shop'];
$notes = isset($data['notes']) ? $data['notes'] : null; // 备注非必填
$writer_id = $data['writer_id'];

$stmt = $conn->prepare("INSERT INTO orders (order_number, customer_id, received_date, delivery_date, total_amount, actual_payment, sales_department, major, title, word_count, requirements, transaction_status, order_status, writer_status, sales_status, payment_shop, notes, writer_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sisssdsssissssssss", $order_number, $customer_id, $received_date, $delivery_date, $total_amount, $actual_payment, $sales_department, $major, $title, $word_count, $requirements, $transaction_status, $order_status, $writer_status, $sales_status, $payment_shop, $notes, $writer_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => '订单添加成功']);
} else {
    echo json_encode(['success' => false, 'message' => '订单添加失败']);
}
?>