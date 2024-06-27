<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$role = $_SESSION['role'];

switch ($role) {
    case 'inkoper':
        header('Location: inkoper_dashboard.php');
        break;
    case 'magazijnmeester':
        header('Location: magazijnmeester_dashboard.php');
        break;
    case 'magazijnmedewerker':
        header('Location: magazijnmedewerker_dashboard.php');
        break;
    case 'bezorger':
        header('Location: bezorger_dashboard.php');
        break;
    case 'verkoper':
        header('Location: verkoper_dashboard.php');
        break;
    default:
        echo "Invalid role";
        break;
}
?>
