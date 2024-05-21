<?php
namespace Bas\Classes;

class Klant {
    private $klantNaam;
    private $klantPassword;
    private $klantEmail;
    private $klantAdres;
    private $klantWoonplaats;
    private $klantPostcode;

    public function __construct($naam, $password, $email, $adres, $woonplaats, $postcode) {
        $this->klantNaam = $naam;
        $this->klantPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->klantEmail = $email;
        $this->klantAdres = $adres;
        $this->klantWoonplaats = $woonplaats;
        $this->klantPostcode = $postcode;
    }

    public function voegToe() {
        require 'database.php';

        global $pdo;
        $sql = "INSERT INTO klant (klantNaam, Password , klantEmail, klantAdres, klantWoonplaats, klantPostcode) 
                VALUES (:klantNaam, :klantPassword, :klantEmail, :klantAdres, :klantWoonplaats, :klantPostcode)";
        $stmt = $pdo->prepare($sql);
        
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
}
?>
