<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'verkoper') {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Verkoper Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Verkoper Dashboard</h1>
    <ul>
        <li><a href="add_klant.php">Voeg nieuwe klant toe</a></li>
        <li><a href="search_klant.php">Zoek klant</a></li>
        <li><a href="view_verkooporders.php">Bekijk verkooporders</a></li>
    </ul>
</body>
</html>
