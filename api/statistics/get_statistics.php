<?php
session_start();
require_once '../../db/db_connect.php';

if (!isset($_SESSION['employee_id'])) {
    echo json_encode(['success' => false, 'message' => '未授权访问']);
    exit;
}

$stmt = $conn->prepare("SELECT COUNT(*) as customer_count FROM customers");
$stmt->execute();
$customer_result = $stmt->get_result();
$customer_row = $customer_result->fetch_assoc();

$stmt = $conn->prepare("SELECT COUNT(*) as order_count FROM orders");
$stmt->execute();
$order_result = $stmt->get_result();
$order_row = $order_result->fetch_assoc();

$stmt = $conn->prepare("SELECT COUNT(*) as after_sale_count FROM after_sales");
$stmt->execute();
$after_sale_result = $stmt->get_result();
$after_sale_row = $after_sale_result->fetch_assoc();

$stmt = $conn->prepare("SELECT SUM(total_amount) as amount_total FROM orders");
$stmt->execute();
$amount_result = $stmt->get_result();
$amount_row = $amount_result->fetch_assoc();

$stmt = $conn->prepare("SELECT SUM(word_count) as word_count_total FROM orders");
$stmt->execute();
$word_count_result = $stmt->get_result();
$word_count_row = $word_count_result->fetch_assoc();

echo json_encode(['success' => true, 'data' => [
    'customer_count' => $customer_row['customer_count'],
    'order_count' => $order_row['order_count'],
    'after_sale_count' => $after_sale_row['after_sale_count'],
    'amount_total' => $amount_row['amount_total'],
    'word_count_total' => $word_count_row['word_count_total']
]]);
?>