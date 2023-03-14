<?php
// Page connection pour se connecter à la base de donnée
try {

    $db = new PDO('mysql:host=localhost;dbname=MISSION4;charset=utf8',
        'root',
        'root');
}
catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}
