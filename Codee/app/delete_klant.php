<?php
require 'Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $klantId = $_POST['klantId'];


    $sql = "DELETE FROM klant WHERE klantId = :klantId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':klantId' => $klantId]);

    if ($stmt->rowCount()) {
        echo "Klant succesvol verwijderd!";
    } else {
        echo "Fout bij het verwijderen van klant.";
    }
}


?>



