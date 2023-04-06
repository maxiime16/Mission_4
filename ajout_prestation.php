<?php
include_once 'header.php';

// si on appuie sur valider ça envoie à la base de donnée
if (isset($_POST['valider'])) {
    // on fait appel à une procedure stockée qui permet d'ajouter un véhicule s'il n'existe pas
    $ajout_fourniture = $db->prepare("CALL AjoutPrestation(?, ?, ?, ?, ?, ?,? ,? ,?)");
    $ajout_fourniture->execute(array(
        $_POST['dateD'],
        $_POST['dateF'],
        $_POST['numero'],
        $_POST['etat'],
        $_POST['fournisseur'],
        $_POST['nature'],
        $_POST['numBon'],
        $_POST['prix'],
        $_SESSION["id"]));

    //on fait un popup pour confirmer que la fourniture est ajoutée
    echo '<script type="text/javascript">';
    echo 'alert("Prestation ajoutée");';
    echo '</script>';
};
?>
<!-- Bouton qui permet de retourner à l'accueil -->
<a href="carnet_sante.php"> <button>Retour</button></a>


<h1>Ajout Ordre de réparation:</h1>
<!-- partie qui permet d'afficher les infos du véhicule -->
<div style="border: 2px solid black">
    <?php // On fait appel à la procédure et on l'exécute

    $_SESSION["id"];

    $afficher = $db->prepare("CALL afficher(?,?)");
    $afficher->execute(array('vehicule', $_SESSION["id"]));
    // On affiche tous les résultats
    $resultats = $afficher->fetchAll();
    foreach ($resultats as $resultat) { ?>
        <div>N° interne véhicule: <?php echo $resultat['v_num_interne'] ?></div>
        <div>Désignation:<?php echo $resultat['v_marque'] . " " . $resultat['v_modele'] ?></div>
        <div>Nature véhicule:<?php echo $resultat['v_nature'] ?></div>
        <div>Code parc:<?php echo $resultat['v_code_parc'] ?></div>
    <?php }; ?>
</div>

<!-- Formulaire pour ajouter la fourniture -->
<div>
    <h2>Main d'œuvre à ajouter</h2>
    <form action="" method="post">
        <label for="dateD">Date debut</label>
        <input type="date" name="dateD" id="dateD" value="<?php echo date("Y-m-d") ?>" required><br>

        <label for="dateF">Date fin</label>
        <input type="date" name="dateF" id="dateF" value="<?php echo date("Y-m-d") ?>" required><br>

        <label for="numero">Numéro marché: </label>
        <input type="number" name="numero" id="numero" required><br>

        <label for="etat">Etat: </label>
        <input type="text" name="etat" id="etat" required><br>

        <label for="fournisseur">Fournisseur: </label>
        <input type="text" name="fournisseur" id="fournisseur" required><br>

        <label for="nature">Nature: </label>
        <input type="text" name="nature" id="nature" required><br>

        <label for="numBon">Numéro bon: </label>
        <input type="text" name="numBon" id="numBon" required><br>

        <label for="prix">Prix</label>
        <input type="number" name="prix" id="prix" required><br>

        <input type="submit" value="Ajouter" name="valider" id="valider">
    </form>
</div>