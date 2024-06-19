<?php
include 'Database.php';
include 'Classes/Klant.php';

use Bas\Classes\Klant;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $klantId = $_POST['klantId'];
    $klant = new Klant($pdo);
    $klantData = $klant->getKlantById($klantId);
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Klant Gegevens Bijwerken</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Klant Gegevens Bijwerken</h1>
    <form action="update_klant_process.php" method="post">
        <input type="hidden" name="klantId" value="<?php echo htmlspecialchars($klantData['klantId']); ?>">
        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" value="<?php echo htmlspecialchars($klantData['klantNaam']); ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($klantData['klantEmail']); ?>" required><br>

        <label for="telefoon">Woonplaats:</label>
        <input type="text" id="telefoon" name="telefoon" value="<?php echo htmlspecialchars($klantData['klantWoonplaats']); ?>" required><br>

        <label for="adres">Adres:</label>
        <input type="text" id="adres" name="adres" value="<?php echo htmlspecialchars($klantData['klantAdres']); ?>" required><br>

        <label for="adres">Postcode:</label>
        <input type="text" id="Postcode" name="Postcode" value="<?php echo htmlspecialchars($klantData['klantPostcode']); ?>" required><br>


        <button type="submit">Bijwerken</button>
    </form>
</body>
</html>
