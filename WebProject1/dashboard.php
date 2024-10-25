<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แดชบอร์ด</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: 20px auto; }
        h1 { text-align: center; }
        a { display: block; text-align: center; margin: 20px; padding: 10px; background-color: #007bff; color: white; text-decoration: none; }
        a:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>ยินดีต้อนรับ <?php echo $_SESSION['role']; ?></h1>
        <a href="logout.php">ออกจากระบบ</a>
    </div>
</body>
</html>