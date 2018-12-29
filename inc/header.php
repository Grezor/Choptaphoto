<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Starter Template for Bootstrap</title>
    <link rel="stylesheet" href="css/app.css">
    <!-- Bootstrap core CSS -->


    <!-- Custom styles for this template -->
    <link href="../css/app.css" rel="stylesheet">
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
                          <a class="nav-link ml-lg-0" href="index.html">Acceuil
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
                          <a class="nav-link " href="cart.php">panier</a>
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

                      <?php if (isset($_SESSION['auth'])): ?>
                          <li class="nav-item "><a class="nav-link" href="logout.php">Se deconnecter</a></>
                          <!-- Si la personnes est un admin alors il a le mennu admin -->
                          <?php if ($_SESSION['auth']->role == 'admin'): ?>
                              <li class="nav-item"><a class="nav-link" href="admin.php">administration</a></li>
                          <?php endif; ?>
                      <?php else: ?>
                           <li class="nav-item">
                              <a class="nav-link" href="login.php">Se connecter </a>
                          </li>
                      <?php endif; ?>
                  </ul>
              </div>
              <div class="phone-inline my-2 my-lg-0">

                  <h6>
                      <span class="fas fa-phone"></span> 03 04 05 06 07 </h6>
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
