<?php
include_once ('header.php');
$afficher_vehicule = $db->prepare('SELECT * FROM vehicule');
$afficher_vehicule->execute();
$resultats = $afficher_vehicule->fetchAll();

?>
<h1>Liste des véhicules</h1>
<a href="ajoutVehicule.php">
    <button>Ajouter un véhicule</button>
</a>
<table>
    <tr class="tr_top">
        <th id="th_CDS">N° interne</th>
        <th>Désignation</th>
        <th>Nature</th>
        <th></th>
    </tr>
    <?php foreach ($resultats as $resultat){ ?>
    <tr>
        <td><?php echo $resultat['v_num_interne']?></td>
        <td><?php echo $resultat['v_marque']." ".$resultat['v_modele']?></td>
        <td><?php echo $resultat['v_nature'];?></td>
        <td style="border=10px;">
            <form action='carnet_sante.php' method='post'>
                <input type='submit' value='Voir carnet de santé'>
                <input name='id_num_interne' type='hidden' value="<?php echo $_SESSION['id'] = htmlspecialchars($resultat['v_num_interne']); ?>">
            </form>
        </td>
    </tr>
    <?php }; ?>
</table>