<?php
// acteur Nouaman Guendoul
require 'Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];

    $sql = "DELETE FROM verkooporders WHERE verkooporder_id = :order_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':order_id' => $order_id]);

    if ($stmt->rowCount()) {
        echo "Sales order successfully deleted!";
    } else {
        echo "Error deleting sales order.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Sales Order</title>
</head>
<body>
    <h1>Delete Sales Order</h1>
    <form action="delete_verkooporder_order.php" method="POST">
        <label for="order_id">Order ID:</label>
        <input type="text" id="order_id" name="order_id" required><br>
        <button type="submit">Delete</button>
    </form>
</body>
</html>
