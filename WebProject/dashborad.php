<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="path/to/adminlte.css">
    <script src="path/to/sweetalert.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Equipment Loan System</h1>
        <p>User Role: <?php echo $_SESSION['role']; ?></p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>