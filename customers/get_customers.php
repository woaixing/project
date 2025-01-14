<?php
session_start();
require_once '../../db/db_connect.php';

if (!isset($_SESSION['employee_id'])) {
    echo json_encode(['success' => false, 'message' => '未授权访问']);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM customers");
$stmt->execute();
$result = $stmt->get_result();

$customers = array();
while ($row = $result->fetch_assoc()) {
    $customers[] = $row;
}

echo json_encode(['success' => true, 'data' => $customers]);
?>