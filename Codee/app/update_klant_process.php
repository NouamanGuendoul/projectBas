<?php
include 'Database.php';
include 'Classes/Klant.php';

use Bas\Classes\Klant;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $klantId = $_POST['klantId'];
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $telefoon = $_POST['telefoon'];
    $adres = $_POST['adres'];
    $Postcode = $_POST['Postcode'];

    $klant = new Klant($pdo);
    $klant->updateKlant($klantId, $naam, $email, $Postcode, $telefoon, $adres);

    header('Location: view_klant.php');
    exit();
}
?>
