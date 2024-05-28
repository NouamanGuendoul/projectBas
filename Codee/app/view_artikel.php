<?php// acteur Nouaman Guendoul ?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Artikelen Bekijken</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
        <nav>
            <ul>
                <li><a href="Main.php">Home</a></li>
                <li><a href="voeg_klant_toe.php">inloggen/registeren</a></li>
                <li><a href="view_artikel.php">Artikel</a></li>
                <li><a href="view_verkooporders.php">Verkooporder</a></li>
            </ul>
        </nav>
    </header>
<h1>Artikelen Bekijken</h1>
<table>
    <thead>
        <tr>
            <th>Omschrijving</th>
            <th>Inkoopprijs</th>
            <th>Verkoopprijs</th>
            <th>Voorraad</th>
            <th>Min. Voorraad</th>
            <th>Max. Voorraad</th>
            <th>Locatie</th>
        </tr>
    </thead>
    <tbody >
        <?php
        include 'Database.php';
        include 'Classes/Artikel.php';

        use Bas\Classes\Artikel;

        $artikel = new Artikel($pdo); // Geef de PDO-instantie door
        $artikelen = $artikel->getAllArtikelen();

        foreach ($artikelen as $artikel): ?>
            <tr>
                <td><?php echo htmlspecialchars($artikel['artOmschrijving']); ?></td>
                <td><?php echo htmlspecialchars($artikel['artInkoop']); ?></td>
                <td><?php echo htmlspecialchars($artikel['artVerkoop']); ?></td>
                <td><?php echo htmlspecialchars($artikel['artVoorraad']); ?></td>
                <td><?php echo htmlspecialchars($artikel['artMinVoorraad']); ?></td>
                <td><?php echo htmlspecialchars($artikel['artMaxVoorraad']); ?></td>
                <td><?php echo htmlspecialchars($artikel['artLocatie']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<form action="create_artikel.php">
    <button>Nieuw Artikel</button>
</form>


</body>
</html>
