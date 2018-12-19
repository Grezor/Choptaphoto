<?php
//==============================================================
//       Confirmation adresse mail
//==============================================================
# On envoye un lien à l'utilisateur afin qu'il confirme son compte, ce lien contient l'id du compte en question
# ainsi que le token généré lors de la phase d'inscription.
# Il nous suffit alors de vérifier que ces 2 informations correspondent.
# Lorsque les informations correspondent on va passer la valeur de confirmation_token à null et on va aussi sauvegarder
# la date de confirmation dans le champs confirmed_at.
# Ce champs nous permettra de savoir si oui ou non l'utilisateur a un compte validé ou pas.


$user_id = $_GET['id'];
$token = $_GET['token'];

// on se connecte a la base de donnée
require_once 'inc/db.php';
// requete préparer, puis on la stock dans une variable
$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
// on execute la requete, avec un tableau user_id
$req->execute([$user_id]);
// puis on recupere les informations
$user = $req->fetch();
session_start();

$user_id = $_GET['id'];
$token = $_GET['token'];
require 'inc/db.php';
$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$req->execute([$user_id]);
$user = $req->fetch();
session_start();

if ($user && $user->confirmation_token == $token) {
    $pdo->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?')->execute([$user_id]);
    $_SESSION['flash']['success'] = 'Votre compte a bien été validé';
    $_SESSION['auth'] = $user;
    header('Location: account.php');
} else {
    $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
    header('Location: login.php');
}