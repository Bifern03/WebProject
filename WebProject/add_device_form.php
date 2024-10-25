<form method="POST" action="add_device.php">
    <input type="text" name="name" placeholder="Device Name" required>
    <select name="category_id" required>
        <!-- Populate categories from database -->
    </select>
    <button type="submit">Add Device</button>
</form>