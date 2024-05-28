<?php
// acteur Nouaman Guendoul
namespace Bas\Classes;

class Artikel {
    private $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createArtikel($omschrijving, $inkoop, $verkoop, $voorraad, $minVoorraad, $maxVoorraad, $locatie) {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO artikel 
                (artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie) 
                VALUES 
                (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $omschrijving, $inkoop, $verkoop, $voorraad, 
                $minVoorraad, $maxVoorraad, $locatie
            ]);
            
            // Controleer of de invoeging succesvol was
            if ($stmt->rowCount() == 0) {
                throw new \Exception('Het invoegen van het artikel is mislukt.');
            }
        } catch (\Exception $e) {
            echo 'Fout bij het invoegen van artikel: ',  $e->getMessage(), "\n";
        }
    }

    
    public function getAllArtikelen() {
        try {
            $stmt = $this->pdo->query("SELECT artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie FROM artikel");
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            echo 'Fout bij het ophalen van artikelen: ',  $e->getMessage(), "\n";
            return [];
        }
    }
}

