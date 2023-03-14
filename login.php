<?php
include_once 'masqué/connexion.php';
session_start();

if (isset($_POST['valider'])) {
    // on regarde s'ils correspondent a une personne de la bdd
    $verif = $db->prepare('CALL afficher(?,?)');
    $verif->execute(array("users",""));
    $users = $verif->fetchAll();
    foreach ($users as $user) {
        if ($user['u_identifiant'] === $_POST['login'] && (password_verify($_POST['password'], $user['u_password']))) {
            unset($_POST['password'],$user['password']);
            //S'il y a un utilisateur, on fait les cookies de sessions
            $_SESSION['connected']="OK";
            $_SESSION['identifiant']=$_POST['login'];
        } else {
            $message_erreur = 'Identifiant ou mot de passe incorrect ';
        }
    }
}
// S'il n'y a pas de personne connectée
if (!isset($_SESSION['connected'])) {
    if(isset($message_erreur)){
        echo "<div>$message_erreur</div>";
    } ?>
    <!-- Le formulaire de connection -->
    <div>
        <form action="" method="post">
            <label for="login">Identifiant</label>
            <input type="text" name="login" id="login" required>

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>

            <input type="submit" name="valider" id="valider">
        </form>
    </div>
<?php } else {
    header("Location: index.php");
};