<?php
session_start();
require_once '../../db/db_connect.php';

if (!isset($_SESSION['employee_id']) || $_SESSION['role_id'] != 1) {
    echo json_encode(['success' => false, 'message' => '未授权访问']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$department_id = $data['department_id'];
$role_id = $data['role_id'];
$username = $data['username'];
$full_name = isset($data['full_name']) ? $data['full_name'] : null; // 姓名非必填
$email = $data['email'];
$password = password_hash($data['password'], PASSWORD_DEFAULT); // 加密密码
$status = $data['status'];

$stmt = $conn->prepare("INSERT INTO employees (department_id, role_id, username, full_name, email, password, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iisssss", $department_id, $role_id, $username, $full_name, $email, $password, $status);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => '员工添加成功']);
} else {
    echo json_encode(['success' => false, 'message' => '员工添加失败']);
}
?>