<?php
$host = 'localhost';  // ชื่อโฮสต์ของฐานข้อมูล
$db = 'db'; // ชื่อฐานข้อมูลที่คุณสร้าง
$user = 'root'; // ชื่อผู้ใช้ฐานข้อมูล
$pass = ''; // รหัสผ่าน (ถ้ามี)

try {
    // สร้างการเชื่อมต่อกับฐานข้อมูล
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ตั้งค่าการแสดงข้อผิดพลาด
} catch (PDOException $e) {
    // หากเกิดข้อผิดพลาดในการเชื่อมต่อ
    echo 'Connection failed: ' . $e->getMessage();
}
?>