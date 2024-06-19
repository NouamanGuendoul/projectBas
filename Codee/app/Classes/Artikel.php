<?php
namespace Bas\Classes;

class Artikel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllArtikelen() {
        $stmt = $this->pdo->query('SELECT * FROM artikel');
        return $stmt->fetchAll();
    }

    public function getArtikelById($artId) {
        $stmt = $this->pdo->prepare('SELECT * FROM artikel WHERE artId = ?');
        $stmt->execute([$artId]);
        return $stmt->fetch();
    }

    public function updateArtikel($artId, $artOmschrijving, $artInkoop, $artVerkoop, $artVoorraad, $artMinVoorraad, $artMaxVoorraad, $artLocatie) {
        $stmt = $this->pdo->prepare('UPDATE artikel SET artOmschrijving = ?, artInkoop = ?, artVerkoop = ?, artVoorraad = ?, artMinVoorraad = ?, artMaxVoorraad = ?, artLocatie = ? WHERE artId = ?');
        $stmt->execute([$artOmschrijving, $artInkoop, $artVerkoop, $artVoorraad, $artMinVoorraad, $artMaxVoorraad, $artLocatie, $artId]);
    }
    public function updateArtikelOmschrijving($artikelId, $omschrijving) {
        $stmt = $this->pdo->prepare('UPDATE artikel SET artOmschrijving = ? WHERE artId = ?');
        $stmt->execute([$omschrijving, $artikelId]);
    }
}
?>
