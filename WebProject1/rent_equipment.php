<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $equipment_id = $_POST['equipment_id'];

    $stmt = $pdo->prepare("INSERT INTO rentals (user_id, equipment_id) VALUES (:user_id, :equipment_id)");
    $stmt->execute(['user_id' => $user_id, 'equipment_id' => $equipment_id]);
    echo "<script>alert('ยืมอุปกรณ์สำเร็จ');</script>";
}

// ดึงข้อมูลอุปกรณ์ที่สามารถยืมได้
$stmt = $pdo->query("SELECT * FROM equipment WHERE status_id = (SELECT id FROM statuses WHERE name = 'พร้อมให้ยืม')");
$equipments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ยืมอุปกรณ์</title>
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
        <h1>ยืมอุปกรณ์</h1>
        <form method="POST">
            <select name="equipment_id" required>
                <option value="">เลือกอุปกรณ์</option>
                <?php foreach ($equipments as $equipment): ?>
                    <option value="<?php echo $equipment['id']; ?>"><?php echo $equipment['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">ยืมอุปกรณ์</button>
        </form>

        <h2>อุปกรณ์ที่สามารถยืมได้</h2>
        <table>
            <thead>
                <tr>
                    <th>ชื่ออุปกรณ์</th>
                    <th>หมวดหมู่</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($equipments as $equipment): ?>
                    <tr>
                        <td><?php echo $equipment['name']; ?></td>
                        <td><?php echo $categories[$equipment['category_id']]['name']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>