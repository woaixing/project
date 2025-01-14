<?php
$host = 'localhost';       // 数据库主机
$username = 'root';        // 数据库用户名
$password = 'password';    // 数据库密码
$dbname = 'paper_order_system'; // 数据库名称

// 创建数据库连接
$conn = new mysqli($host, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("数据库连接失败: " . $conn->connect_error);
}

// 设置字符编码
$conn->set_charset("utf8mb4");
?>