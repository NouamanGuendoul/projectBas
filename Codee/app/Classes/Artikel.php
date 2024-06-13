<?php
namespace Bas\Classes;

class Artikel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createArtikel($artOmschrijving, $artInkoop, $artVerkoop, $artVoorraad, $artMinVoorraad, $artMaxVoorraad, $artLocatie) {
        $sql = "INSERT INTO artikel (artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie)
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

     public function getAllArtikelen() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM artikel");
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            echo 'Fout bij het ophalen van artikelen: ',  $e->getMessage(), "\n";
            return [];
        }
    }
}
?>
