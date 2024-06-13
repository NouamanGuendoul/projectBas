<?php
// acteur Nouaman Guendoul

class Database {
    private $host = '127.0.0.1';
    private $db_name = 'projectbas';
    private $username = 'root';
    private $password = '';
    public $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }
}

// Instantiate the Database to set the global $pdo
$database = new Database();
$pdo = $database->pdo;
?>
