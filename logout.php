<?php
// partie deconnexion
session_start();
//unset — Détruit une variable
unset($_SESSION['auth']);
// message d'alerte
$_SESSION['flash']['success'] = "vous etes maintenant deconnecter";
// redirige la personne
header('Location: login.php');