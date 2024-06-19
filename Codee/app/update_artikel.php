update_art<?php
include 'Database.php';
include 'Classes/Artikel.php';

use Bas\Classes\Artikel;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $artId = $_POST['artId'];
    $artikel = new Artikel($pdo);
    $artikelData = $artikel->getArtikelById($artId);
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Artikel Bijwerken</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Artikel Bijwerken</h1>
    <form action="update_artikel_process.php" method="post">
        <input type="hidden" name="artId" value="<?php echo htmlspecialchars($artikelData['artId']); ?>">
        <label for="artOmschrijving">Omschrijving:</label>
        <input type="text" id="artOmschrijving" name="artOmschrijving" value="<?php echo htmlspecialchars($artikelData['artOmschrijving']); ?>" required><br>

        <label for="artInkoop">Inkoopprijs:</label>
        <input type="text" id="artInkoop" name="artInkoop" value="<?php echo htmlspecialchars($artikelData['artInkoop']); ?>" required><br>

        <label for="artVerkoop">Verkoopprijs:</label>
        <input type="text" id="artVerkoop" name="artVerkoop" value="<?php echo htmlspecialchars($artikelData['artVerkoop']); ?>" required><br>

        <label for="artVoorraad">Voorraad:</label>
        <input type="text" id="artVoorraad" name="artVoorraad" value="<?php echo htmlspecialchars($artikelData['artVoorraad']); ?>" required><br>

        <label for="artMinVoorraad">Min. Voorraad:</label>
        <input type="text" id="artMinVoorraad" name="artMinVoorraad" value="<?php echo htmlspecialchars($artikelData['artMinVoorraad']); ?>" required><br>

        <label for="artMaxVoorraad">Max. Voorraad:</label>
        <input type="text" id="artMaxVoorraad" name="artMaxVoorraad" value="<?php echo htmlspecialchars($artikelData['artMaxVoorraad']); ?>" required><br>

        <label for="artLocatie">Locatie:</label>
        <input type="text" id="artLocatie" name="artLocatie" value="<?php echo htmlspecialchars($artikelData['artLocatie']); ?>" required><br>

        <button type="submit">Bijwerken</button>
    </form>
</body>
</html>
