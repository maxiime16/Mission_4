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
<h1>Carnet de santé du véhicule</h1>

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
        <div>Compteur dernière prise carb:<?php echo $resultat['v_compteur'] ?></div>
    <?php }; ?>
</div>

<!-- partie qui permet d'afficher les fournitures -->
<div>
    <h2>Fournitures:</h2>
    <form action='ajout_fourniture.php' method='post'>
        <input type='submit' value='Ajouter fourniture'>
        <input name='id_num_interne' type='hidden' value="<?php echo htmlspecialchars($resultat['v_num_interne']); ?>">
    </form>
    <table>
        <tr class="tr_top">
            <th>Date</th>
            <th>Désignation</th>
            <th>Code</th>
            <th>Qté</th>
            <th>Type</th>
            <th>N° Bon</th>
        </tr>
        <?php // On fait appel à la procédure et on l'exécute
        $afficher = $db->prepare("CALL afficher(?,?)");
        $afficher->execute(array('fourniture', $_SESSION["id"]));
        // On affiche tous les résultats dans un tableau
        $resultats = $afficher->fetchAll();
        foreach ($resultats as $resultat) { ?>
            <tr class="tr_carnet_data">
                <td><?php echo $resultat['f_date'] ?></td>
                <td><?php echo $resultat['f_designation'] ?></td>
                <td><?php echo $resultat['f_code'] ?></td>
                <td><?php echo $resultat['f_quantite'] ?></td>
                <td><?php echo $resultat['f_type'] ?></td>
                <td><?php echo $resultat['f_num_bon'] ?></td>
            </tr>
        <?php };
        $afficher->closeCursor(); // On ferme la requête pour éviter les conflits avec les autres requêtes / affichage ?>
    </table>
    <!-- Partie qui permet d'afficher le prix total des fournitures -->
    <?php
    // On fait appel à la procédure et on l'exécute
    $prix_total = $db->prepare('CALL SommePrix(?,?)');
    $prix_total->execute(array('fourniture', $_SESSION["id"]));
    // On affiche le résultat
    $resultat = $prix_total->fetch();
    ?>
    <div> Total fournitures: <?php echo number_format($resultat['total_prix'], 2); ?> €</div>
    <?php $prix_total->closeCursor(); // On ferme la requête pour éviter les conflits avec les autres requêtes / affichage ?>
</div>

<!-- partie qui permet d'afficher les mains d'œuvre -->
<div>
    <h2>Main d'œuvre:</h2>
    <table>
        <tr class="tr_top">
            <th>Date M.O.</th>
            <th>Libellé des travaux</th>
            <th>Temps</th>
            <th>N° OR</th>
        </tr>
        <?php $afficher = $db->prepare("CALL afficher(?,?)");
        $afficher->execute(array('main doeuvre', $_SESSION["id"]));
        $resultats = $afficher->fetchAll();
        foreach ($resultats as $resultat) { ?>
            <tr class="tr_carnet_data">
                <td><?php echo $resultat['mo_date'] ?></td>
                <td><?php echo $resultat['mo_libelle'] ?></td>
                <td><?php echo $resultat['mo_temps'] ?></td>
                <td><?php echo $resultat['mo_num_ordre_rep'] ?></td>
            </tr>
        <?php };
        $afficher->closeCursor(); // // On ferme la requête pour éviter les conflits avec les autres requêtes / affichage ?>
    </table>
    <!-- Partie qui permet d'afficher le prix total des mains d'œuvres -->
    <?php
    // On fait appel à la procédure et on l'exécute
    $prix_total = $db->prepare('CALL SommePrix(?,?)');
    $prix_total->execute(array('main doeuvre', $_SESSION["id"]));
    // On affiche le résultat
    $resultat = $prix_total->fetch();
    ?>
    <div> Total fournitures: <?php echo number_format($resultat['total_prix'], 2); ?> €</div>
    <?php $prix_total->closeCursor(); // On ferme la requête pour éviter les conflits avec les autres requêtes / affichage ?>
</div>

<!-- partie qui permet d'afficher les prestations  -->
<div>
    <h2>Bon de prestation extérieure:</h2>
    <table>
        <tr class="tr_top">
            <th>Date de début</th>
            <th>Date de fin</th>
            <th>N° de marché</th>
            <th>État</th>
            <th>Fournisseur</th>
            <th>Nature des travaux</th>
            <th>N° de bon</th>
        </tr>
        <?php // On fait appel à la procédure et on l'exécute
        $afficher = $db->prepare("CALL afficher(?,?)");
        $afficher->execute(array('prestation', $_SESSION["id"]));
        // On affiche tous les résultats dans un tableau
        $resultats = $afficher->fetchAll();
        foreach ($resultats as $resultat) { ?>
            <tr class="tr_carnet_data">
                <td><?php echo $resultat['p_date_debut'] ?></td>
                <td><?php echo $resultat['p_date_fin'] ?></td>
                <td><?php echo $resultat['p_num_marche'] ?></td>
                <td><?php echo $resultat['p_etat'] ?></td>
                <td><?php echo $resultat['p_fournisseur'] ?></td>
                <td><?php echo $resultat['p_nature_travaux'] ?></td>
                <td><?php echo $resultat['p_num_bon'] ?></td>
            </tr>
        <?php };
        $afficher->closeCursor(); // On ferme la requête pour éviter les conflits avec les autres requêtes / affichage ?>
    </table>
    <?php
    // On fait appel à la procédure et on l'exécute
    $prix_total = $db->prepare('CALL SommePrix(?,?)');
    $prix_total->execute(array('prestation', $_SESSION["id"]));
    // On affiche le résultat
    $resultat = $prix_total->fetch(); ?>
    <div> Total fournitures: <?php echo number_format($resultat['total_prix'], 2); ?> €</div>
    <?php $prix_total->closeCursor(); // On ferme la requête pour éviter les conflits avec les autres requêtes / affichage ?>
</div>

<!-- partie qui permet d'afficher les contrôles  -->
<div>
    <h2>Contrôles:</h2>
    <table>
        <tr class="tr_top">
            <th>Désignation</th>
            <th>Date contrôle</th>
            <th>N°OR</th>
            <th>Cpt contrôle</th>
            <th>Cpt dernier contrôle</th>
            <th>Observation</th>
            <th>Seuil</th>
            <th>Date dernier contrôle</th>
            <th>Date prochain contrôle</th>
        </tr>
        <?php $afficher = $db->prepare("CALL afficher(?,?)");
        $afficher->execute(array('controle', $_SESSION["id"]));
        $resultats = $afficher->fetchAll();
        foreach ($resultats as $resultat) { ?>
            <tr class="tr_carnet_data">
                <td><?php echo $resultat['c_designation'] ?></td>
                <td><?php echo $resultat['c_date'] ?></td>
                <td><?php echo $resultat['c_num_or'] ?></td>
                <td><?php echo $resultat['c_cpt'] ?></td>
                <td><?php echo $resultat['c_cpt_dernier'] ?></td>
                <td><?php echo $resultat['c_seuil'] ?></td>
                <td><?php echo $resultat['c_date_dernier'] ?></td>
                <td><?php echo $resultat['c_date_prochain'] ?></td>
            </tr>
        <?php };
        $afficher->closeCursor(); // On ferme la requête pour éviter les conflits avec les autres requêtes / affichage ?>
    </table>
    <?php
    // On fait appel à la procédure et on l'exécute
    $prix_total = $db->prepare('CALL SommePrix(?,?)');
    $prix_total->execute(array('controle', $_SESSION["id"]));
    // On affiche le résultat
    $resultat = $prix_total->fetch(); ?>
    <div> Total fournitures: <?php echo number_format($resultat['total_prix'], 2); ?> €</div>
    <?php $prix_total->closeCursor(); // On ferme la requête pour éviter les conflits avec les autres requêtes / affichage ?>

</div>