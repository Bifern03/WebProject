<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $device_id = $_POST['device_id'];

    $stmt = $pdo->prepare("UPDATE devices SET status = 'available' WHERE id = :device_id");
    $stmt->execute(['device_id' => $device_id]);

    $stmt = $pdo->prepare("UPDATE loans SET returned_at = NOW() WHERE device_id = :device_id AND returned_at IS NULL");
    $stmt->execute(['device_id' => $device_id]);

    echo "<script>swal('Success', 'Device returned successfully!', 'success');</script>";
}
?>