<?php
session_start();
if (!isset($_SESSION['connected'])) {
    header("Location: login.php");
}
include_once('masqué/connexion.php');

// on démarre une session pour récupérer l'id du véhicule

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/styles.css">
    <title>Entretien parc véhicule</title>
</head>
<body>
<h1 style="text-align: center">Application de gestion des véhicules</h1>

<!-- Affichage de la personne connecté + bouton "se déconnecter" -->
<div style="border-bottom: 1px solid black">
    <?php
    echo "Connecté en tant que " . $_SESSION['identifiant'] . ", <a href='masqué/logout.php'>se déconnecter</a>";
    ?>
</div>
