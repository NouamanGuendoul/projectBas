<?php
include 'Database.php';
include 'Classes/Verkooporder.php';
include 'Classes/Artikel.php';

use Bas\Classes\Verkooporder;
use Bas\Classes\Artikel;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['orderId'];
    $klantId = $_POST['klantId'];
    $artikelId = $_POST['artId'];
    $hoeveelheid = $_POST['hoeveelheid'];
    $datum = $_POST['datum'];
    $omschrijving = $_POST['artOmschrijving'];

    $verkooporder = new Verkooporder($pdo);
    $verkooporder->updateOrder($orderId, $klantId, $artikelId, $hoeveelheid, $datum);

    $artikel = new Artikel($pdo);
    $artikel->updateArtikelOmschrijving($artikelId, $omschrijving);

    header('Location: view_verkooporders.php');
    exit();
}
?>
