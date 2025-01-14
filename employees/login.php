<?php
session_start();
require_once '../../db/db_connect.php';

$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'];
$password = $data['password'];

$stmt = $conn->prepare("SELECT employee_id, password, role_id FROM employees WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['employee_id'] = $row['employee_id'];
        $_SESSION['role_id'] = $row['role_id'];
        echo json_encode(['success' => true, 'message' => '登录成功']);
    } else {
        echo json_encode(['success' => false, 'message' => '密码错误']);
    }
} else {
    echo json_encode(['success' => false, 'message' => '用户不存在']);
}
?>