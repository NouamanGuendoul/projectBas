<?php
include 'Database.php';
include 'Classes/Artikel.php';
include 'Classes/Leverancier.php';
include 'Classes/Inkooporder.php';

use Bas\Classes\Artikel;
use Bas\Classes\Leverancier;
use Bas\Classes\Inkooporder;

$artikel = new Artikel($pdo);
$leverancier = new Leverancier($pdo);
$inkooporder = new Inkooporder($pdo);

$artikelen = $artikel->getAllArtikelen();
$leveranciers = $leverancier->getAllLeveranciers();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $levId = $_POST['levId'];
    $artId = $_POST['artId'];
    $inkOrdDatum = $_POST['inkOrdDatum'];
    $inkOrdBestAantal = $_POST['inkOrdBestAantal'];
    $inkOrdStatus = isset($_POST['inkOrdStatus']) ? 1 : 0;

    $inkooporder->createInkooporder($levId, $artId, $inkOrdDatum, $inkOrdBestAantal, $inkOrdStatus);
    echo "Inkooporder succesvol aangemaakt!";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Inkooporder Aanmaken</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
        <nav>
            <ul>
                <li><a href="Main.php">Home</a></li>
                <li><a href="voeg_klant_toe.php">inloggen/registeren</a></li>
                <li><a href="create_artikel.php">Artikel</a></li>
                <li><a href="view_verkooporders.php">Verkooporder</a></li>
            </ul>
        </nav>
    </header>
    <h1>Inkooporder Aanmaken</h1>
    <form method="post" action="create_inkooporder.php">
        <label for="levId">Leverancier:</label>
        <select id="levId" name="levId" required>
            <option value="" disabled selected>Selecteer een leverancier</option>
            <?php foreach ($leveranciers as $leverancier): ?>
                <option value="<?php echo htmlspecialchars($leverancier['levId']); ?>">
                    <?php echo htmlspecialchars($leverancier['levNaam']); ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="artId">Artikel:</label>
        <select id="artId" name="artId" required>
            <option value="" disabled selected>Selecteer een artikel</option>
            <?php foreach ($artikelen as $artikel): ?>
                <option value="<?php echo htmlspecialchars($artikel['artId']); ?>">
                    <?php echo htmlspecialchars($artikel['artOmschrijving']); ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="inkOrdDatum">Datum:</label>
        <input type="date" id="inkOrdDatum" name="inkOrdDatum" required><br>

        <label for="inkOrdBestAantal">Bestel Aantal:</label>
        <input type="number" id="inkOrdBestAantal" name="inkOrdBestAantal" required><br>

        <label for="inkOrdStatus">Status:</label>
        <input type="checkbox" id="inkOrdStatus" name="inkOrdStatus" value="1"><br>

        <button type="submit">Aanmaken</button>
    </form>
</body>
</html>
