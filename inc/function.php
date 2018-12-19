<?php
function debug($variable)
{
    echo '<pre>' . print_r($variable, true) . '<pre>';
}

// Function token , reset mot de passe - $lenght = taille du token
function str_random($lenght)
{
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $lenght)), 0, $lenght);
}

// function demarre un session start si il n'y a pas d'auth
function logged_only()
{
    if (!isset($_SESSION['auth'])) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['flash']['danger'] = "vous n'avez pas le droit d'accéder a cette page ";
        header('Location:login.php');
        exit();
    }

}

//
function auth($d)
{
    global $pdo;
    $req = $pdo->prepare('SELECT * FROM users WHERE username:username AND password=password');
    $req->execute($d);
    echo '--';
    $data = $req->fetchAll();
    print_r($data);
}