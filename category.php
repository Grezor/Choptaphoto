<?php 
require 'inc/db.php';
require 'paniers.class.php';
$DB = new DB();
$panier = new panier($DB);

?>
<!DOCTYPE html>
<html lang="fr" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>fruit easy </title>

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
</head>

<body>

    <!-- Start Header Area -->
    <?php
             include "inc/header.php"
             ?>

    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8 col-md-7">
                
                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">
                        <?php $products = $DB->requete('SELECT * FROM products')?>
                        <?php foreach ( $products as $product):?>

                            <div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
                                <div class="content">
                                    <div class="content-overlay"></div>
                                    <img class="content-image img-fluid d-block mx-auto" src="images/<?= $product->id; ?>" alt="">
                                    <div class="content-details fadeIn-bottom">
                                        <div class="bottom d-flex align-items-center justify-content-center">
                                            <a href="addpanier.php?id=<?= $product->id; ?>"><i class="fa fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="price">
                                    <h5><?= $product->name ?></h5>
                                    <h3><?= number_format($product->price, 2, ',', ''); ?> €</h3>
                                </div>
                            </div>

                        <?php endforeach; ?>

                        
                        
                        
                        
                        
                        
                        
                        
                        
                    </div>
                </section>
              
                
               
            </div>
           
        </div>
    </div>
<?php 
include 'inc/footer.php'; ?>
  





    <script src="js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/nouislider.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
