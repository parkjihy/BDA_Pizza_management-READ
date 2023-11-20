<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "review3";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // 여기에서 다양한 데이터베이스 설정을 할 수 있습니다.
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
