<?php



use PHPUnit\Framework\TestCase;
use Bas\Classes\Klant;

class KlantTest extends TestCase
{
    protected $pdo;

    protected function setUp(): void
    {
        // Mock the PDO object to avoid actual database interaction
        $this->pdo = $this->createMock(\PDO::class);

        // Create a stub for the PDOStatement class.
        $stmt = $this->createMock(\PDOStatement::class);

        // Configure the PDOStatement stub.
        $stmt->method('execute')
             ->willReturn(true);

        $stmt->method('rowCount')
             ->willReturn(1);

        // Configure the PDO stub.
        $this->pdo->method('prepare')
                  ->willReturn($stmt);

        // Overwrite the global $pdo variable to use the mock
        global $pdo;
        $pdo = $this->pdo;
    }

    public function testVoegToe()
    {
        
        $klant = new Klant(
            'Test Naam',
            'TestPassword123',
            'test@example.com',
            'Test Adres',
            'Test Woonplaats',
            '1234 AB'
        );

        // Capture the output of the voegToe method
        ob_start();
        $klant->voegToe();
        $output = ob_get_clean();

        // Assert that the output matches the expected success message
        $this->assertEquals('Nieuwe klant succesvol toegevoegd!', $output);
    }
}
