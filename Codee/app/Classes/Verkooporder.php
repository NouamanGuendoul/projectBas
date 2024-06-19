<?php
namespace Bas\Classes;

class Verkooporder {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getVerkooporders() {
        $stmt = $this->pdo->query('
            SELECT vo.verkOrdId, k.klantNaam, a.artOmschrijving, vo.verkOrdBestAantal, vo.verkOrdStatus, vo.verkOrdDatum 
            FROM verkooporder vo
            JOIN klant k ON vo.klantId = k.klantId
            JOIN artikel a ON vo.artId = a.artId
        ');
        return $stmt->fetchAll();
    }

    public function getVerkooporderByKlantNaam($klantNaam) {
        $stmt = $this->pdo->prepare('
            SELECT vo.verkOrdId, k.klantNaam, a.artOmschrijving, vo.verkOrdBestAantal, vo.verkOrdStatus, vo.verkOrdDatum 
            FROM verkooporder vo
            JOIN klant k ON vo.klantId = k.klantId
            JOIN artikel a ON vo.artId = a.artId
            WHERE k.klantNaam LIKE :klantNaam
        ');
        $stmt->execute([':klantNaam' => "%$klantNaam%"]);
        return $stmt->fetchAll();
    }

    public function deleteVerkoopOrder($verkOrdId) {
        $stmt = $this->pdo->prepare('DELETE FROM verkooporder WHERE verkOrdId = :verkOrdId');
        return $stmt->execute([':verkOrdId' => $verkOrdId]);
    }

    public function getOrderById($orderId) {
        $stmt = $this->pdo->prepare('SELECT * FROM verkooporder WHERE verkOrdId = ?');
        $stmt->execute([$orderId]);
        return $stmt->fetch();
    }

    public function updateOrder($orderId, $klantId, $artikelId, $hoeveelheid, $datum) {
        $stmt = $this->pdo->prepare('UPDATE verkooporder SET klantId = ?, artId = ?, verkOrdBestAantal = ?, verkOrdDatum = ? WHERE verkOrdId = ?');
        $stmt->execute([$klantId, $artikelId, $hoeveelheid, $datum, $orderId]);
    }
}



?>
