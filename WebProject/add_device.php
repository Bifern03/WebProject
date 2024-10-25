<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $status = 'available';

    $stmt = $pdo->prepare("INSERT INTO devices (name, category_id, status) VALUES (:name, :category_id, :status)");
    $stmt->execute([
        'name' => $name,
        'category_id' => $category_id,
        'status' => $status
    ]);

    echo "<script>swal('Success', 'Device added successfully!', 'success');</script>";
}
?>