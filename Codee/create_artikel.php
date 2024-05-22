
<?php
include 'Database.php';
include 'Classes/Artikel.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $artOmschrijving = $_POST['artOmschrijving'];
    $artInkoop = $_POST['artInkoop'];
    $artVerkoop = $_POST['artVerkoop'];
    $artVoorraad = $_POST['artVoorraad'];
    $artMinVoorraad = $_POST['artMinVoorraad'];
    $artMaxVoorraad = $_POST['artMaxVoorraad'];
    $artLocatie = $_POST['artLocatie'];

    $artikel = new Artikel($pdo);
    $artikel->createArtikel($artOmschrijving, $artInkoop, $artVerkoop, $artVoorraad, $artMinVoorraad, $artMaxVoorraad, $artLocatie);

    echo "Artikel succesvol toegevoegd!";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Artikelen Aanmaken</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
     <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="voeg_klant_toe.php">inloggen/registeren</a></li>
                <li><a href="create_artikel.php">Artikel</a></li>
                <li><a href="/app/view_verkooporders.php">Verkooporder</a></li>
            </ul>
        </nav>
    </header>
    <h1> Artikelen Aanmaken</h1>
    <form method="post" action="create_artikel.php">
        <label for="artOmschrijving">Omschrijving:</label>
        <input type="text" id="artOmschrijving" name="artOmschrijving" required><br>
        
        <label for="artInkoop">Inkoopprijs:</label>
        <input type="text" id="artInkoop" name="artInkoop" required><br>
        
        <label for="artVerkoop">Verkoopprijs:</label>
        <input type="text" id="artVerkoop" name="artVerkoop" required><br>
        
        <label for="artVoorraad">Voorraad:</label>
        <input type="text" id="artVoorraad" name="artVoorraad" required><br>
        
        <label for="artMinVoorraad">Min. Voorraad:</label>
        <input type="text" id="artMinVoorraad" name="artMinVoorraad" required><br>
        
        <label for="artMaxVoorraad">Max. Voorraad:</label>
        <input type="text" id="artMaxVoorraad" name="artMaxVoorraad" required><br>
        
        <label for="artLocatie">Locatie:</label>
        <input type="text" id="artLocatie" name="artLocatie" required><br>
        
        <button type="submit">Opslaan</button>
    </form>

</body>
</html>
