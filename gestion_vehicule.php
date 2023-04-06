<?php
include_once('header.php');
$_SESSION['id'] = session_destroy();
$afficher_vehicule = $db->prepare('SELECT * FROM vehicule');
$afficher_vehicule->execute();
$resultats = $afficher_vehicule->fetchAll();

?>
<h1>Liste des véhicules</h1>
<a href="ajout_vehicule.php">
    <button>Ajouter un véhicule</button>
</a>

<!-- tableau pour afficher la liste des véhicules -->
<table>
    <tr class="tr_top">
        <th id="th_CDS">N° interne</th>
        <th>Désignation</th>
        <th>Nature</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($resultats as $resultat) { ?>
        <tr>
            <td><?php echo $resultat['v_num_interne'] ?></td>
            <td><?php echo $resultat['v_marque'] . " " . $resultat['v_modele'] ?></td>
            <td><?php echo $resultat['v_nature']; ?></td>
            <td style="border=10px;">
                <form action='carnet_sante.php' method='post'>
                    <input type='submit' value='Voir carnet de santé'>
                    <input name='id_num_interne' type='hidden'
                           value="<?php echo htmlspecialchars($resultat['v_num_interne']); ?>">
                </form>
            </td>
            <td style="border=10px;">
                <form action='ordre_reparation.php' method='post'>
                    <input type='submit' value='Voir ordre de réparation'>
                    <input name='id_num_interne' type='hidden'
                           value="<?php echo htmlspecialchars($resultat['v_num_interne']); ?>">
                </form>
            </td>
        </tr>
    <?php }; ?>
</table>