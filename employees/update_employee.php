<?php
session_start();
require_once '../../db/db_connect.php';

if (!isset($_SESSION['employee_id']) || $_SESSION['role_id'] != 1) {
    echo json_encode(['success' => false, 'message' => '未授权访问']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$employee_id = $data['employee_id'];
$department_id = isset($data['department_id']) ? $data['department_id'] : null;
$role_id = isset($data['role_id']) ? $data['role_id'] : null;
$username = isset($data['username']) ? $data['username'] : null;
$full_name = isset($data['full_name']) ? $data['full_name'] : null;
$email = isset($data['email']) ? $data['email'] : null;
$status = isset($data['status']) ? $data['status'] : null;

$query = "UPDATE employees SET ";
$params = array();
$types = "";
if ($department_id) {
    $query .= "department_id=?, ";
    $params[] = $department_id;
    $types .= "i";
}
if ($role_id) {
    $query .= "role_id=?, ";
    $params[] = $role_id;
    $types .= "i";
}
if ($username) {
    $query .= "username=?, ";
    $params[] = $username;
    $types .= "s";
}
if ($full_name) {
    $query .= "full_name=?, ";
    $params[] = $full_name;
    $types .= "s";
}
if ($email) {
    $query .= "email=?, ";
    $params[] = $email;
    $types .= "s";
}
if ($status) {
    $query .= "status=?, ";
    $params[] = $status;
    $types .= "s";
}
$query = rtrim($query, ", "); // 去掉最后的逗号和空格
$query .= " WHERE employee_id=?";
$params[] = $employee_id;
$types .= "i";

$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => '员工信息更新成功']);
} else {
    echo json_encode(['success' => false, 'message' => '员工信息更新失败']);
}
?>