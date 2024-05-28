<?php
// acteur Nouaman Guendoul
include 'Database.php';
include 'Classes/Verkooporder.php';

$verkooporder = new Verkooporder($pdo);
$orders = $verkooporder->getVerkooporders();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['klantNaam'])) {
    $klantNaam = $_POST['klantNaam'];
    $orders = $verkooporder->getVerkooporderByKlantNaam($klantNaam);
    if (empty($orders)) {
        echo "Geen orders gevonden voor klant: $klantNaam";
    }
}
?>

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
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                
                <td><?php echo htmlspecialchars($order['klantNaam']); ?></td>
                <td><?php echo htmlspecialchars($order['artOmschrijving']); ?></td>
                <td><?php echo htmlspecialchars($order['verkOrdBestAantal']); ?></td>
                <td><?php echo htmlspecialchars($order['verkOrdStatus']); ?></td>
                <td><?php echo htmlspecialchars($order['verkOrdDatum']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
