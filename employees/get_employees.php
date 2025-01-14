<?php
session_start();
require_once '../../db/db_connect.php';

if (!isset($_SESSION['employee_id'])) {
    echo json_encode(['success' => false, 'message' => '未授权访问']);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM employees");
$stmt->execute();
$result = $stmt->get_result();

$employees = array();
while ($row = $result->fetch_assoc()) {
    $employees[] = $row;
}

echo json_encode(['success' => true, 'data' => $employees]);
?>