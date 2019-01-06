<?php
session_start();
require 'inc/function.php';
logged_only();
if (!empty($_POST)) {
    require_once 'inc/db.php';

    $user_id = $_SESSION['auth']->id;
    //==============================================================
    //       Changement de mot de passe
    //==============================================================
    if (!empty($_POST['password']) && $_POST['password'] != $_POST['password_confirm']) {
        $_SESSION['flash']['error'] = "les mot de passe ne sont pas identique";
        // si le champs n'est pas vide
    } elseif (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $req = $pdo->prepare('UPDATE users SET password= ? WHERE id= ?')->execute([$password, $user_id]);
        $_SESSION['flash']['success'] = "Votre mot de passe a bien été mis a jour";
    }

//    if (!empty($_POST['role'])) {
//
//        $role = $_POST['role'];
//        $req = $pdo->prepare('UPDATE users SET role = ? WHERE id= ?')->execute([$role, $user_id]);
//        $_SESSION['flash']['success'] = "Votre role a bien été mis a jour";
//    }

}
require 'inc/header.php'; ?>
    <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">
<h5>Bonjour <?= $_SESSION['auth']->username; ?> - Role :<?= $_SESSION['auth']->role; ?></h5>
<?php

$jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
$datefr = $jour[date("w")]." ".date("d")." ".$mois[date("n")]." ".date("Y");
echo "Nous sommes le ". $datefr;
?> 

<form method="post" action="">
    <div class="form-group">
        <input class="form-control" type="password" name="password" placeholder="changer de mot de passe">
    </div>
    <div class="form-group">
        <input class="form-control" type="password" name="password_confirm" placeholder="confirmation de mot de passe">
    </div>

    <button class="btn btn-primary"> mettre a jour</button>

</form>

<?php //require 'inc/footer.php'; ?>
