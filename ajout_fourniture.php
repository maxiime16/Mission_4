<?php
include_once 'header.php';

// si on appuie sur valider ça envoie à la base de donnée
if (isset($_POST['valider'])) {
    // on fait appel à une procedure stockée qui permet d'ajouter un véhicule s'il n'existe pas
    $ajout_fourniture = $db->prepare("CALL AjoutFourniture(?, ?, ?, ?, ?, ?, ?, ?)");
    $ajout_fourniture->execute(array($_POST['date'],
        $_POST['designation'],
        $_POST['code'],
        $_POST['quantite'],
        $_POST['prix'],
        $_POST['type'],
        $_POST['numBon'],
        $_SESSION["id"]));

    //on fait un popup pour confirmer que la fourniture est ajoutée
    echo '<script type="text/javascript">';
    echo 'alert("Fourniture ajoutée");';
    echo '</script>';
};
?>
<!-- Bouton qui permet de retourner à l'accueil -->
<a href="carnet_sante.php"> <button>Retour</button></a>


<h1>Ajout fourniture:</h1>
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
    <?php }; ?>
</div>

<!-- Formulaire pour ajouter la fourniture -->
<div>
    <h2>Fourniture à ajouter</h2>
    <form action="" method="post">
        <label for="date">Date</label>
        <input type="date" name="date" id="date" value="<?php echo date("Y-m-d") ?>" required><br>

        <label for="designation">Désignation</label>
        <input type="text" name="designation" id="designation" required><br>

        <label for="code">Code</label>
        <input type="text" name="code" id="code" required><br>

        <label for="quantite">Quantité</label>
        <input type="number" name="quantite" id="quantite" required><br>

        <label for="prix">Prix</label>
        <input type="number" name="prix" id="prix" required><br>

        <label for="type">Type</label>
        <input type="text" name="type" id="type" required><br>

        <label for="numBon">Numero bon</label>
        <input type="text" name="numBon" id="numBon" required><br>

        <input type="submit" value="Ajouter" name="valider" id="valider">
    </form>
</div>