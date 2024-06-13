<?php
namespace Bas\Classes;

require_once 'Database.php';

class Klant {
    private $klantNaam;
    private $klantPassword;
    private $klantEmail;
    private $klantAdres;
    private $klantWoonplaats;
    private $klantPostcode;
    private $pdo;

    public function __construct($naam = null, $password = null, $email = null, $adres = null, $woonplaats = null, $postcode = null) {
        $this->klantNaam = $naam;
        $this->klantPassword = $password ? password_hash($password, PASSWORD_DEFAULT) : null;
        $this->klantEmail = $email;
        $this->klantAdres = $adres;
        $this->klantWoonplaats = $woonplaats;
        $this->klantPostcode = $postcode;

        global $pdo;
        $this->pdo = $pdo;
    }

    public function voegToe() {
        $sql = "INSERT INTO klant (klantNaam, Klantpassword, klantEmail, klantAdres, klantWoonplaats, klantPostcode) 
                VALUES (:klantNaam, :klantPassword, :klantEmail, :klantAdres, :klantWoonplaats, :klantPostcode)";
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            ':klantNaam' => $this->klantNaam,
            ':klantPassword' => $this->klantPassword,
            ':klantEmail' => $this->klantEmail,
            ':klantAdres' => $this->klantAdres,
            ':klantWoonplaats' => $this->klantWoonplaats,
            ':klantPostcode' => $this->klantPostcode
        ]);

        if ($stmt->rowCount()) {
            echo "Nieuwe klant succesvol toegevoegd!";
        } else {
            echo "Fout bij het toevoegen van klant.";
        }
    }

    public function deleteKlant($klantId) {
        $sql = 'DELETE FROM klant WHERE klantId = :klantId';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':klantId' => $klantId]);

        if ($stmt->rowCount()) {
            echo "Klant succesvol verwijderd!";
        } else {
            echo "Fout bij het verwijderen van klant.";
        }
    }

    public function readAll() {
        $sql = "SELECT klantId, klantNaam, klantEmail, klantAdres, klantWoonplaats, klantPostcode FROM klant";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $klanten = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $klanten;
    }

    public function zoekKlant($naam) {
        $sql = "SELECT klantId, klantNaam, klantEmail, klantAdres, klantWoonplaats, klantPostcode FROM klant WHERE klantNaam = :klantNaam LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':klantNaam' => $naam]);

        $klant = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $klant;
    }
}
