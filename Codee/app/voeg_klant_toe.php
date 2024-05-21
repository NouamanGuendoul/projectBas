<?php
require 'database.php';
require 'Classes/klant.php';

use Bas\Classes\klant;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $klantNaam = $_POST['klantNaam'];
    $klantPassword = $_POST['klantPassword'];
    $klantEmail = $_POST['klantEmail'];
    $klantAdres = $_POST['klantAdres'];
    $klantWoonplaats = $_POST['klantWoonplaats'];
    $klantPostcode = $_POST['klantPostcode'];

    $klant = new Klant($klantNaam, $klantPassword, $klantEmail, $klantAdres, $klantWoonplaats, $klantPostcode);
    $klant->voegToe();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voeg Klant Toe</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="voeg_klant_toe.php">inloggen/registeren</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Nieuwe Klant Toevoegen</h1>
        <form action="voeg_klant_toe.php" method="POST">
            <label for="klantNaam">Naam:</label>
            <input type="text" id="klantNaam" name="klantNaam" required><br>
            <label for="klantPassword">Wachtwoord:</label>
            <input type="password" id="klantPassword" name="klantPassword" required><br>
            <label for="klantEmail">Email:</label>
            <input type="email" id="klantEmail" name="klantEmail" required><br>
            <label for="klantAdres">Adres:</label>
            <input type="text" id="klantAdres" name="klantAdres" required><br>
            <label for="klantWoonplaats">Woonplaats:</label>
            <input type="text" id="klantWoonplaats" name="klantWoonplaats" required><br>
            <label for="klantPostcode">Postcode:</label>
            <input type="text" id="klantPostcode" name="klantPostcode" required><br>
            <button type="submit">Voeg Klant Toe</button>
        </form>
    </main>
</body>
</html>
