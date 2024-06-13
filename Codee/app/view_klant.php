<?php
include 'Classes/Klant.php';

use Bas\Classes\Klant;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $klantNaam = $_POST['klantNaam'];

    $klant = new Bas\Classes\Klant();
    $result = $klant->zoekKlant($klantNaam);

    if ($result) {
        echo "Klant gevonden: " . json_encode($result);
    } else {
        echo "Klant niet gevonden.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Customer</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav>
            <ul>
                <li><a href="Main.php">Home</a></li>
                <li><a href="view_klant.php">inloggen/registeren</a></li>
                <li><a href="view_artikel.php">Artikel</a></li>
                <li><a href="view_verkooporders.php">Verkooporder</a></li>
                <li><a href="create_inkooporder.php">inkooporder</a></li>
            </ul>
        </nav>
    <form method="post" action="view_klant.php">
        <label for="klantNaam">Zoeken op Klant Naam:</label>
        <input type="text" id="klantNaam" name="klantNaam" required>
        <button type="submit">Zoek</button>
    </form>

    <?php if (isset($result) && $result): ?>
        <h2>Gevonden Klant:</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Klant Naam</th>
                <th>Email</th>
                <th>Adres</th>
                <th>Woonplaats</th>
                <th>Postcode</th>
                <th>acties</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($result['klantId']); ?></td>
                <td><?php echo htmlspecialchars($result['klantNaam']); ?></td>
                <td><?php echo htmlspecialchars($result['klantEmail']); ?></td>
                <td><?php echo htmlspecialchars($result['klantAdres']); ?></td>
                <td><?php echo htmlspecialchars($result['klantWoonplaats']); ?></td>
                <td><?php echo htmlspecialchars($result['klantPostcode']); ?></td>
                <td>
                            <form method="post" action="delete_klant.php">
                                <input type="hidden" name="klantId" value="<?php echo htmlspecialchars($result['klantId']); ?>">
                                <button type="submit" name="delete">Verwijderen</button>
                            </form>

                    </td>
            </tr>
        </table>
    <?php elseif (isset($result)): ?>
        <p>Klant niet gevonden.</p>
    <?php endif; ?>

    <form action="voeg_klant_toe.php">
    <button>Nieuw klant</button>
</form>
</body>
</html>
