<?php

if (session_status() === PHP_SESSION_NONE) {
   session_start();
}
require_once 'inc/db.php';
require_once 'paniers.class.php';
$DB = new DB();
$panier = new panier($DB);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
            CSS
            ============================================= -->
            <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/nouislider.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main_panier.css">
    <title>Starter Template for Bootstrap</title>
    <link rel="stylesheet" href="css/app.css">
 
  
</head>

<body>

      <!-- header -->
      <header>
          <nav class="navbar navbar-expand-lg navbar-light bg-light top-header">
              <div class="logo text-center">
                  <h1 class="logo">
                      <a class="navbar-brand" href="index.php">
                          <span class="sub"></span>Photo-Mobile</a>
                  </h1>
              </div>
              <button class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon">
                      <i class="fas fa-bars"></i>
                  </span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mx-auto">
                      <li class="nav-item active">
                          <a class="nav-link ml-lg-0" href="index.php">Acceuil
                              <span class="sr-only">(current)</span>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link scroll" href="#about">A Propos</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link scroll" href="#services">Services</a>
                      </li>

                      <li class="nav-item">
                          <a class="nav-link " href="panier.php">panier</a>
                      </li>

                      <li class="nav-item">
                          <a class="nav-link " href="category.php">category</a>
                      </li>

                      <li class="nav-item">
                          <a class="nav-link scroll" href="#contact">Contact</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link scroll" href="#contact">Contact</a>
                      </li>

                      <?php // si l'utilisateur n'est pas admin, il n'affiche pas la partie admin
                       if (isset($_SESSION['auth'])): ?>
                          <li class="nav-item "><a class="nav-link" href="logout.php">Se deconnecter</a></>
                          <!-- Si la personnes est un admin alors il a le mennu admin -->
                          <?php if ($_SESSION['auth']->role == 'admin'): ?>
                              <li class="nav-item"><a class="nav-link" href="admin.php">administration</a></li>
                          <?php endif; ?>
                      <?php else: ?>
                           <li class="nav-item">
                              <a class="nav-link" href="login.php">Login </a>
                          </li>
                      <?php endif; ?>
                  </ul>
              </div>
              <div class="phone-inline my-2 my-lg-0">
                  <a href="panier.php">
                  <span id="count">(<?= $panier->count();?>) </span></a>-
                      <span id="total"><?= number_format($panier->total()*1.2, 2, ',', ''); ?> €</span>

              </div>

          </nav>

      <!-- //header -->



<main role="main" class="container">
  <br>
  <br>
    <?php if (isset($_SESSION['flash'])): ?>
        <?php foreach ($_SESSION['flash'] as $type => $message): ?>
            <div class="alert alert-<?= $type; ?>">
                <?= $message; ?>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
