<?php
// acteur Nouaman Guendoul
require 'Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['verkOrdId']) && isset($_POST['new_status'])) {
        $verkOrdId = $_POST['verkOrdId'];
        $new_status = $_POST['new_status'];

        $sql = "UPDATE verkooporder SET verkOrdStatus = :new_status WHERE verkOrdId = :verkOrdId";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':new_status' => $new_status, ':verkOrdId' => $verkOrdId]);

        if ($stmt->rowCount() > 0) {
            echo "Order status successfully updated!";
        } else {
            echo "Error updating order status.";
        }
    } else {
        echo "Verkooporder ID and new status are required.";
    }
}
?>


<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order Status</title>
</head>
<body>
    <h1>Update Order Status</h1>
    <form action="view_verkooporders.php" method="POST">
        <label for="order_id">Order ID:</label>
        <input type="text" id="order_id" name="order_id" required><br>
        <label for="new_status">New Status:</label>
        <input type="text" id="new_status" name="new_status" required><br>
        <button type="submit">Update Status</button>
    </form>
</body>
</html>
