<?php
class Artikel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createArtikel($artOmschrijving, $artInkoop, $artVerkoop, $artVoorraad, $artMinVoorraad, $artMaxVoorraad, $artLocatie) {
        $sql = "INSERT INTO ARTIKEL(artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie) 
                VALUES (:artOmschrijving, :artInkoop, :artVerkoop, :artVoorraad, :artMinVoorraad, :artMaxVoorraad, :artLocatie)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':artOmschrijving' => $artOmschrijving,
            ':artInkoop' => $artInkoop,
            ':artVerkoop' => $artVerkoop,
            ':artVoorraad' => $artVoorraad,
            ':artMinVoorraad' => $artMinVoorraad,
            ':artMaxVoorraad' => $artMaxVoorraad,
            ':artLocatie' => $artLocatie
        ]);
    }
}
?>
