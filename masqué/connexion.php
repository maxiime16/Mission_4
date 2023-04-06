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
//SELECT equipe.chauffeur, mission.motif, mission.datemission, mission.heurerdv, mission.lieurdv, mission.destination FROM mission INNER JOIN equipe ON equipe.code = mission.codeequipe;