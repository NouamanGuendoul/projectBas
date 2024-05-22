<?php
include 'Database.php';
include 'Classes/Verkooporder.php';

$verkooporder = new Verkooporder($pdo);
$orders = $verkooporder->getVerkooporders();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['orderId'])) {
    $orderId = $_POST['orderId'];
    $order = $verkooporder->getVerkooporderById($orderId);
    if ($order) {
        $orders = [$order];
    } else {
        echo "Geen order gevonden met ID: $orderId";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Verkooporders Inzien</title>
</head>
<body>
    <h1>BBB - Verkooporders Inzien</h1>
    <form method="post" action="view_verkooporders.php">
        <label for="orderId">Zoeken op Order ID:</label>
        <input type="text" id="orderId" name="orderId">
        <button type="submit">Zoek</button>
    </form>
    <table border="1">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Klant ID</th>
                <th>Artikel ID</th>
                <th>Aantal</th>
                <th>Status</th>
                <th>Datum</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['verkOrdId']); ?></td>
                    <td><?php echo htmlspecialchars($order['klantId']); ?></td>
                    <td><?php echo htmlspecialchars($order['artId']); ?></td>
                    <td><?php echo htmlspecialchars($order['verkOrdBestAantal']); ?></td>
                    <td><?php echo htmlspecialchars($order['verkOrdStatus']); ?></td>
                    <td><?php echo htmlspecialchars($order['verkOrdDatum']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
