<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $device_id = $_POST['device_id'];

    $stmt = $pdo->prepare("UPDATE devices SET status = 'loaned' WHERE id = :device_id");
    $stmt->execute(['device_id' => $device_id]);

    $stmt = $pdo->prepare("INSERT INTO loans (user_id, device_id) VALUES (:user_id, :device_id)");
    $stmt->execute(['user_id' => $user_id, 'device_id' => $device_id]);

    echo "<script>swal('Success', 'Device loaned successfully!', 'success');</script>";
}
?>