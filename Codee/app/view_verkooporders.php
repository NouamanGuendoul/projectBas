<?php
require 'config.php'; // Database connection settings
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'verkoper') {
    header('Location: login.php');
    exit;
}

$orders = $pdo->query('SELECT * FROM verkooporders')->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $verkOrdId = $_POST['verkOrdId'];
    $verkOrdStatus = $_POST['verkOrdStatus'];

    $stmt = $pdo->prepare('UPDATE verkooporders SET verkOrdStatus = ? WHERE verkOrdId = ?');
    $stmt->execute([$verkOrdStatus, $verkOrdId]);

    header('Location: view_verkooporders.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>View and Update Verkooporders</title>
</head>
<body>
    <h1>Verkooporders</h1>
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Klant ID</th>
            <th>Order Datum</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?php echo $order['verkOrdId']; ?></td>
            <td><?php echo $order['klantId']; ?></td>
            <td><?php echo $order['verkOrdDatum']; ?></td>
            <td><?php echo $order['verkOrdStatus']; ?></td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="verkOrdId" value="<?php echo $order['verkOrdId']; ?>">
                    <select name="verkOrdStatus">
                        <option value="Pending" <?php if ($order['verkOrdStatus'] == 'Pending') echo 'selected'; ?>>Pending</option>
                        <option value="Processing" <?php if ($order['verkOrdStatus'] == 'Processing') echo 'selected'; ?>>Processing</option>
                        <option value="Shipped" <?php if ($order['verkOrdStatus'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                        <option value="Delivered" <?php if ($order['verkOrdStatus'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                        <option value="Cancelled" <?php if ($order['verkOrdStatus'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                    </select>
                    <input type="submit" value="Update Status">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
