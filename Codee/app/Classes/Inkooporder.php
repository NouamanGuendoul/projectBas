<?php
namespace Bas\Classes;

class Inkooporder {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createInkooporder($levId, $artId, $inkOrdDatum, $inkOrdBestAantal, $inkOrdStatus) {
        $sql = "INSERT INTO inkooporder (levId, artId, inkOrdDatum, inkOrdBestAantal, inkOrdStatus)
                VALUES (:levId, :artId, :inkOrdDatum, :inkOrdBestAantal, :inkOrdStatus)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':levId' => $levId,
            ':artId' => $artId,
            ':inkOrdDatum' => $inkOrdDatum,
            ':inkOrdBestAantal' => $inkOrdBestAantal,
            ':inkOrdStatus' => $inkOrdStatus
        ]);
    }
}
?>
