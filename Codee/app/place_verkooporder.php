<?php
require 'config.php'; // Database connection settings
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'verkoper') {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $klantId = $_POST['klantId'];
    $artIds = $_POST['artIds'];
    $aantallen = $_POST['aantallen'];

    $pdo->beginTransaction();
    try {
        $stmt = $pdo->prepare('INSERT INTO verkooporders (klantId, verkOrdDatum, verkOrdStatus) VALUES (?, ?, ?)');
        $stmt->execute([$klantId, date('Y-m-d'), 'Pending']);
        $verkOrdId = $pdo->lastInsertId();

        $stmt = $pdo->prepare('INSERT INTO verkooporderdetails (verkOrdId, artId, verkOrdAantal) VALUES (?, ?, ?)');
        foreach ($artIds as $index => $artId) {
            $stmt->execute([$verkOrdId, $artId, $aantallen[$index]]);
        }

        $pdo->commit();
        echo "Verkooporder geplaatst!";
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Failed to place order: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Place Verkooporder</title>
</head>
<body>
    <form method="post" action="">
        Klant ID: <input type="text" name="klantId" required><br>
        Artikel IDs: <input type="text" name="artIds[]" required><br>
        Aantal: <input type="text" name="aantallen[]" required><br>
        <input type="button" value="Add More Items" onclick="addItemFields()"><br>
        <input type="submit" value="Place Order">
    </form>
    <script>
        function addItemFields() {
            const form = document.forms[0];
            const newArtId = document.createElement('input');
            newArtId.type = 'text';
            newArtId.name = 'artIds[]';
            newArtId.required = true;

            const newAantal = document.createElement('input');
            newAantal.type = 'text';
            newAantal.name = 'aantallen[]';
            newAantal.required = true;

            form.insertBefore(newArtId, form.childNodes[form.childNodes.length - 2]);
            form.insertBefore(newAantal, form.childNodes[form.childNodes.length - 2]);
            form.insertBefore(document.createElement('br'), form.childNodes[form.childNodes.length - 2]);
        }
    </script>
</body>
</html>
