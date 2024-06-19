<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Verkooporders Inzien</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="Main.php">Home</a></li>
                <li><a href="voeg_klant_toe.php">inloggen/registeren</a></li>
                <li><a href="view_artikel.php">Artikel</a></li>
                <li><a href="view_verkooporders.php">Verkooporder</a></li>
            </ul>
        </nav>
    </header>
    <h1>Verkooporders Inzien</h1>
    <form method="post" action="view_verkooporders.php">
        <label for="klantNaam">Zoeken op Klant Naam:</label>
        <input type="text" id="klantNaam" name="klantNaam">
        <button type="submit">Zoek</button>
    </form>
    <table border="1">
        <thead>
            <tr>
                <th>Klant Naam</th>
                <th>Artikel Omschrijving</th>
                <th>Aantal</th>
                <th>Status</th>
                <th>Datum</th>
                <th>verwijder</th>
                <th>update</th>
            </tr>
        </thead>
        <tbody>
        <?php
include 'Database.php';
include 'Classes/Verkooporder.php';

use Bas\Classes\Verkooporder;

$verkooporder = new Verkooporder($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $verkOrdId = $_POST['verkOrdId'];
    $verkooporder->deleteVerkoopOrder($verkOrdId);
}

// Check if search query is present
if(isset($_POST['klantNaam']) && !empty($_POST['klantNaam'])) {
    $klantNaam = $_POST['klantNaam'];
    $orders = $verkooporder->getVerkooporderByKlantNaam($klantNaam);
} else {
    $orders = $verkooporder->getVerkooporders();
}
?>

            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['klantNaam']); ?></td>
                    <td><?php echo htmlspecialchars($order['artOmschrijving']); ?></td>
                    <td><?php echo htmlspecialchars($order['verkOrdBestAantal']); ?></td>
                    <td>
                        <form method="post" action="update_order_status.php">
                            <input type="hidden" name="verkOrdId" value="<?php echo htmlspecialchars($order['verkOrdId']); ?>">
                            <select name="new_status">
                                <option value="In afwachting" <?php if ($order['verkOrdStatus'] == 'In afwachting') echo 'selected'; ?>>In afwachting</option>
                                <option value="In behandeling" <?php if ($order['verkOrdStatus'] == 'In behandeling') echo 'selected'; ?>>In behandeling</option>
                                <option value="Voltooid" <?php if ($order['verkOrdStatus'] == 'Voltooid') echo 'selected'; ?>>Voltooid</option>
                            </select>

                            <button type="submit">Bijwerken</button>
                        </form>
                    </td>
                    <td><?php echo htmlspecialchars($order['verkOrdDatum']); ?></td>
                    <td>
                        <form method="post" action="view_verkooporders.php" style="display:inline;">
                            <input type="hidden" name="verkOrdId" value="<?php echo htmlspecialchars($order['verkOrdId']); ?>">
                            <button type="submit" name="delete">Verwijderen</button>
                        </form>
                    </td>
                    <td>
                    <form action="update_verkooporder.php" method="post">
                        <input type="hidden" name="orderId" value="<?php echo htmlspecialchars($order['verkOrdId']); ?>">
                        <button type="submit">Update</button>
                    </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
