<?php
$host = 'localhost';
$db = 'equipment_rental';
$user = 'root'; // ชื่อผู้ใช้ฐานข้อมูล
$pass = 'root'; // รหัสผ่าน (ถ้ามี)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>