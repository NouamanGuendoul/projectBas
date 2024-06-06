<?php

use PHPUnit\Framework\TestCase;
use Bas\Classes\Artikel;

class ArtikelTest extends TestCase {
    private $pdo;
    private $artikel;

    protected function setUp(): void {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->exec("
            CREATE TABLE artikel (
                artId INTEGER PRIMARY KEY,
                artOmschrijving TEXT,
                artInkoop REAL,
                artVerkoop REAL,
                artVoorraad INTEGER,
                artMinVoorraad INTEGER,
                artMaxVoorraad INTEGER,
                artLocatie TEXT
            )
        ");

        $this->artikel = new Artikel($this->pdo);
    }

    public function testCreateArtikel() {
        $this->artikel->createArtikel('Test Artikel', 10.0, 20.0, 100, 10, 200, 'Locatie A');

        $stmt = $this->pdo->query("SELECT * FROM artikel WHERE artOmschrijving = 'Test Artikel'");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotEmpty($result);
        $this->assertEquals('Test Artikel', $result['artOmschrijving']);
        $this->assertEquals(10.0, $result['artInkoop']);
        $this->assertEquals(20.0, $result['artVerkoop']);
        $this->assertEquals(100, $result['artVoorraad']);
        $this->assertEquals(10, $result['artMinVoorraad']);
        $this->assertEquals(200, $result['artMaxVoorraad']);
        $this->assertEquals('Locatie A', $result['artLocatie']);
    }

    public function testGetAllArtikelen() {
        $this->artikel->createArtikel('Test Artikel 1', 10.0, 20.0, 100, 10, 200, 'Locatie A');
        $this->artikel->createArtikel('Test Artikel 2', 15.0, 25.0, 150, 15, 250, 'Locatie B');

        $artikelen = $this->artikel->getAllArtikelen();

        $this->assertCount(2, $artikelen);
    }
}
?>
