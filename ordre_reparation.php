<?php
include_once "header.php";
if (!isset($_SESSION["id"])){
    $_SESSION["id"] = htmlspecialchars($_POST['id_num_interne']); // on récupère l'id pour afficher le bon carnet de santé
}
?>
<!-- Bouton qui permet de retourner à l'accueil -->
<a href="gestion_vehicule.php">
    <button>Retour liste véhicule</button>
</a>

<!-- partie qui permet d'afficher les infos du véhicule -->
<div style="border: 2px solid black">
    <?php // On fait appel à la procédure et on l'exécute
    $afficher = $db->prepare("CALL afficher(?,?)");
    $afficher->execute(array('vehicule', $_SESSION["id"]));
    // On affiche tous les résultats
    $resultats = $afficher->fetchAll();
    foreach ($resultats as $resultat) { ?>
        <div>N° interne véhicule: <?php echo $resultat['v_num_interne'] ?></div>
        <div>Désignation:<?php echo $resultat['v_marque'] . " " . $resultat['v_modele'] ?></div>
        <div>Nature véhicule:<?php echo $resultat['v_nature'] ?></div>
        <div>Code parc:<?php echo $resultat['v_code_parc'] ?></div>
        <div>Carburant:<?php echo $resultat['v_carburant'] ?></div>
    <?php }; ?>
</div>
<br>

<!-- tableau pour afficher la liste des véhicules -->
<table>
    <tr class="tr_top">
        <th id="th_CDS">Num de Bon</th>
        <th>Date</th>
        <th>Libelle</th>
        <th>Cout</th>
        <th>Compteur</th>
    </tr>
    <?php $afficher = $db->prepare("CALL afficher(?,?)");
    $afficher->execute(array('main doeuvre', $_SESSION["id"]));
    $resultats = $afficher->fetchAll();
    foreach ($resultats as $resultat) { ?>
        <tr class="tr_carnet_data">
            <td><?php echo $resultat['mo_num_ordre_rep'] ?></td>
            <td><?php echo $resultat['mo_date'] ?></td>
            <td><?php echo $resultat['mo_libelle'] ?></td>
            <td><?php echo $resultat['mo_prix'] ?></td>
            <td>0</td>
        </tr>
    <?php };
    $afficher->closeCursor(); // // On ferme la requête pour éviter les conflits avec les autres requêtes / affichage ?>

    <?php $afficher = $db->prepare("CALL afficher(?,?)");
    $afficher->execute(array('controle', $_SESSION["id"]));
    $resultats = $afficher->fetchAll();
    foreach ($resultats as $resultat) { ?>
        <tr class="tr_carnet_data">
            <td><?php echo $resultat['c_num_or'] ?></td>
            <td><?php echo $resultat['c_date'] ?></td>
            <td><?php echo $resultat['c_designation'] ?></td>
            <td><?php echo $resultat['c_prix'] ?></td>
            <td><?php echo $resultat['c_cpt_dernier'] ?></td>
        </tr>
    <?php };
    $afficher->closeCursor(); // On ferme la requête pour éviter les conflits avec les autres requêtes / affichage ?>
</table>