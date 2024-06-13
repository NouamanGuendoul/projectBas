<?php
namespace Bas\Classes;

class Leverancier {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllLeveranciers() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM leverancier");
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            echo 'Fout bij het ophalen van leveranciers: ',  $e->getMessage(), "\n";
            return [];
        }
    }
}
?>
