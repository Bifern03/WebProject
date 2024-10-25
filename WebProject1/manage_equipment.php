<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $storage_id = $_POST['storage_id'];
    $status_id = $_POST['status_id'];

    $stmt = $pdo->prepare("INSERT INTO equipment (name, category_id, storage_id, status_id) VALUES (:name, :category_id, :storage_id, :status_id)");
    $stmt->execute(['name' => $name, 'category_id' => $category_id, 'storage_id' => $storage_id, 'status_id' => $status_id]);
    echo "<script>alert('เพิ่มอุปกรณ์สำเร็จ');</script>";
}

// ดึงข้อมูลหมวดหมู่, ที่เก็บ, และสถานะ
$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
$storages = $pdo->query("SELECT * FROM storage")->fetchAll(PDO::FETCH_ASSOC);
$statuses = $pdo->query("SELECT * FROM statuses")->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query("SELECT * FROM equipment");
$equipments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>จัดการอุปกรณ์</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: 20px auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="container">
        <h1>จัดการอุปกรณ์</h1>
        <form method="POST">
            <input type="text" name="name" placeholder="ชื่ออุปกรณ์" required>
            <select name="category_id" required>
                <option value="">เลือกหมวดหมู่</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <select name="storage_id" required>
                <option value="">เลือกที่เก็บ</option>
                <?php foreach ($storages as $storage): ?>
                    <option value="<?php echo $storage['id']; ?>"><?php echo $storage['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <select name="status_id" required>
                <option value="">เลือกสถานะ</option>
                <?php foreach ($statuses as $status): ?>
                    <option value="<?php echo $status['id']; ?>"><?php echo $status['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">เพิ่มอุปกรณ์</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ชื่ออุปกรณ์</th>
                    <th>หมวดหมู่</th>
                    <th>ที่เก็บ</th>
                    <th>สถานะ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($equipments as $equipment): ?>
                    <tr>
                        <td><?php echo $equipment['name']; ?></td>
                        <td><?php echo $categories[$equipment['category_id']]['name']; ?></td>
                        <td><?php echo $storages[$equipment['storage_id']]['name']; ?></td>
                        <td><?php echo $statuses[$equipment['status_id']]['name']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>