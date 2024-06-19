<?php
include 'Database.php';
include 'Classes/Verkooporder.php';
include 'Classes/Artikel.php';

use Bas\Classes\Verkooporder;
use Bas\Classes\Artikel;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['orderId'];
    $verkooporder = new Verkooporder($pdo);
    $orderData = $verkooporder->getOrderById($orderId);

    $artikel = new Artikel($pdo);
    $artikelData = $artikel->getArtikelById($orderData['artId']);
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Verkooporder Bijwerken</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Verkooporder Bijwerken</h1>
    <form action="update_verkooporder_process.php" method="post">
        <input type="hidden" name="orderId" value="<?php echo htmlspecialchars($orderData['verkOrdId']); ?>">
        <label for="klantId">Klant ID:</label>
        <input type="text" id="klantId" name="klantId" value="<?php echo htmlspecialchars($orderData['klantId']); ?>" required><br>

        <label for="artId">Artikel ID:</label>
        <input type="text" id="artId" name="artId" value="<?php echo htmlspecialchars($orderData['artId']); ?>" required><br>

        <label for="hoeveelheid">Hoeveelheid:</label>
        <input type="number" id="hoeveelheid" name="hoeveelheid" value="<?php echo htmlspecialchars($orderData['verkOrdBestAantal']); ?>" required><br>

        <label for="datum">Datum:</label>
        <input type="date" id="datum" name="datum" value="<?php echo htmlspecialchars($orderData['verkOrdDatum']); ?>" required><br>

        <label for="artOmschrijving">Artikel Omschrijving:</label>
        <input type="text" id="artOmschrijving" name="artOmschrijving" value="<?php echo htmlspecialchars($artikelData['artOmschrijving']); ?>" required><br>

        <button type="submit">Bijwerken</button>
    </form>
</body>
</html>
