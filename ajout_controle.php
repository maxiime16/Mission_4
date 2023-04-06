<?php
include_once 'header.php';

// si on appuie sur valider ça envoie à la base de donnée
if (isset($_POST['valider'])) {
    // on fait appel à une procedure stockée qui permet d'ajouter un véhicule s'il n'existe pas
    $ajout_fourniture = $db->prepare("CALL AjoutControle(?, ?, ?, ?, ?, ?,? ,? ,?,?,?)");
    $ajout_fourniture->execute(array(
        $_POST['designation'],
        $_POST['date'],
        $_POST['num_or'],
        $_POST['cpt'],
        $_POST['cpt_dernier'],
        $_POST['observation'],
        $_POST['seuil'],
        $_POST['date_dernier'],
        $_POST['date_prochain'],
        $_SESSION["id"],
        $_POST['prix']));

    //on fait un popup pour confirmer que la fourniture est ajoutée
    echo '<script type="text/javascript">';
    echo 'alert("Controle ajoutée");';
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
        <label for="designation">designation: </label>
        <input type="text" name="designation" id="designation" required><br>

        <label for="date">Date: </label>
        <input type="date" name="date" id="date" value="<?php echo date("Y-m-d") ?>" required><br>

        <label for="num_or">Numéro: </label>
        <input type="number" name="num_or" id="num_or" required><br>

        <label for="cpt">cpt: </label>
        <input type="number" name="cpt" id="cpt" required><br>

        <label for="cpt_dernier">dernier cpt: </label>
        <input type="number" name="cpt_dernier" id="cpt_dernier" required><br>

        <label for="observation">observation: </label>
        <input type="text" name="observation" id="observation" required><br>

        <label for="seuil">seuil: </label>
        <input type="number" name="seuil" id="seuil" required><br>

        <label for="date_dernier">Derniere date: </label>
        <input type="date" name="date_dernier" id="date_dernier" value="<?php echo date("Y-m-d") ?>" required><br>

        <label for="date_prochain">Prochaine Date: </label>
        <input type="date" name="date_prochain" id="date_prochain" value="<?php echo date("Y-m-d") ?>" required><br>

        <label for="prix">Prix</label>
        <input type="number" name="prix" id="prix" required><br>

        <input type="submit" value="Ajouter" name="valider" id="valider">
    </form>
</div>

NULL, designation, date, num_or, cpt, cpt_dernier, observation, seuil, date_dernier, date_prochain, id_vehicule, prix
