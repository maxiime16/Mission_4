<?php
include_once ('header.php');
include_once ('connexion.php');

if (isset($_POST['valider'])) {
    // on fait appel a une procedure stockée qui permet d'ajouter un vehicule s'il n'existe pas
    $ajout_vehicule = $db->prepare("CALL ajoutvehicule(?, ?, ?, ?, ?, ?, ?)");
    $ajout_vehicule->execute(array($_POST['num_interne'],
        $_POST['marque'],
        $_POST['modele'],
        $_POST['nature'],
        $_POST['code_parc'],
        $_POST['carburant'],
        $_POST['compteur'] ));
}
?>
<a href="index.php">Retourner a l'accueil</a>
<h1>Ajouter véhicule</h1>
<form action="" method="post">
    <!--Formulaire d'ajout de véhicule-->
    <label for="num_interne">Numéro Interne</label>
    <input type="text" name="num_interne" id="num_interne" required><br>

    <label for="marque">Marque</label>
    <input type="text" name="marque" id="marque" required><br>

    <label for="modele">Modèle</label>
    <input type="text" name="modele" id="modele" required><br>

    <label for="nature">Nature du véhicule</label>
    <input type="text" name="nature" id="nature" required><br>

    <label for="code_parc">Code parc</label>
    <input type="number" name="code_parc" id="code_parc" required><br>

    <label for="carburant">Type de carburant</label>
    <input type="text" name="carburant" id="carburant" required><br>

    <label for="compteur">Compteur à la dernière prise de carburant</label>
    <input type="number" name="compteur" id="compteur" required><br>

    <input type="submit" name="valider" value="Ajouter">
</form>
