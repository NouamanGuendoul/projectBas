<?php
class Verkooporder {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getVerkooporders() {
        $stmt = $this->pdo->query("SELECT * FROM VERKOOPORDERS");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVerkooporderById($verkOrdId) {
        $stmt = $this->pdo->prepare("SELECT * FROM VERKOOPORDERS WHERE verkOrdId = :verkOrdId");
        $stmt->execute([':verkOrdId' => $verkOrdId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
