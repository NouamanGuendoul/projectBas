<?php

use PHPUnit\Framework\TestCase;
use Bas\Classes\Verkooporder;

class VerkooporderTest extends TestCase {
    private $pdo;
    private $verkooporder;

    protected function setUp(): void {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->exec("
            CREATE TABLE klant (
                klantId INTEGER PRIMARY KEY,
                klantNaam TEXT
            );
            CREATE TABLE artikel (
                artId INTEGER PRIMARY KEY,
                artOmschrijving TEXT
            );
            CREATE TABLE verkooporder (
                verkOrdId INTEGER PRIMARY KEY,
                klantId INTEGER,
                artId INTEGER,
                verkOrdBestAantal INTEGER,
                verkOrdStatus TEXT,
                verkOrdDatum TEXT,
                FOREIGN KEY (klantId) REFERENCES klant(klantId),
                FOREIGN KEY (artId) REFERENCES artikel(artId)
            )
        ");

        $this->pdo->exec("INSERT INTO klant (klantNaam) VALUES ('Klant A')");
        $this->pdo->exec("INSERT INTO artikel (artOmschrijving) VALUES ('Artikel A')");

        $this->verkooporder = new Verkooporder($this->pdo);
    }

    public function testGetVerkooporders() {
        $this->pdo->exec("
            INSERT INTO verkooporder (klantId, artId, verkOrdBestAantal, verkOrdStatus, verkOrdDatum)
            VALUES (1, 1, 10, 'Verzonden', '2024-06-06')
        ");

        $orders = $this->verkooporder->getVerkooporders();

        $this->assertCount(1, $orders);
        $this->assertEquals('Klant A', $orders[0]['klantNaam']);
        $this->assertEquals('Artikel A', $orders[0]['artOmschrijving']);
    }

    public function testGetVerkooporderByKlantNaam() {
        $this->pdo->exec("
            INSERT INTO verkooporder (klantId, artId, verkOrdBestAantal, verkOrdStatus, verkOrdDatum)
            VALUES (1, 1, 10, 'Verzonden', '2024-06-06')
        ");

        $orders = $this->verkooporder->getVerkooporderByKlantNaam('Klant A');

        $this->assertCount(1, $orders);
        $this->assertEquals('Klant A', $orders[0]['klantNaam']);
        $this->assertEquals('Artikel A', $orders[0]['artOmschrijving']);
    }
}
?>
