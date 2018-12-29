<?php
require 'db.class.php';
require 'paniers.class.php';
require 'inc/header.php';
$DB = new DB();
$panier = new panier($DB);

?>
<?php

if (isset($_GET['del'])) {
    $panier->supprimer_produit($_GET['del']);
}
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
    <title></title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!--
            CSS
            ============================================= -->
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/ion.rangeSlider.css"/>
    <link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css"/>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main_panier.css">
</head>

<body>


<div class="container">
    <div class="cart-title">
        <div class="row">
            <div class="col-md-6">
                <h6 class="ml-15">Product</h6>
            </div>
            <div class="col-md-2">
                <h6>Price</h6>
            </div>
            <div class="col-md-2">
                <h6>Quantity</h6>
            </div>
            <div class="col-md-2">
                <h6>Total(tva) </h6>
            </div>
        </div>
    </div>

    <!--    requete    -->
    <?php
    $ids = array_keys($_SESSION['panier']);
    if (empty($ids)) {
        $products = array();
    } else {
        $products = $DB->requete('SELECT * FROM products WHERE id IN (' . implode(',', $ids) . ')');
    }
    foreach ($products as $product):

        ?>


        <div class="cart-single-item">
            <div class="row align-items-center">
                <div class="col-md-6 col-12">
                    <div class="product-item d-flex align-items-center">
                        <!--                         class images : img-fluid-->
                        <img src="images/<?= $product->id; ?>.jpg" height="100" class="" alt="">
                        <h6><?= $product->name; ?></h6>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="price"><?= number_format($product->price, 2, ',', ''); ?> €</div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="quantity-container d-flex align-items-center mt-15">
                        <input type="text" class="quantity-amount" value="<?=$_SESSION['panier'][$product->id]?>"/>

                        <div class="arrow-btn d-inline-flex flex-column">

                            <button class="increase arrow" type="button" title="Increase Quantity"><i
                                        class="fa fa-arrow-up"></i></button>
                            <button class="decrease arrow" type="button" title="Decrease Quantity"><i
                                        class="fa fa-arrow-down"></i></button>
                        </div>
                        <a href="cart.php?del=<?= $product->id; ?>" class="increase arrow" type="button" title="Increase Quantity"><i class="fa fa-close"></i></a>
                    </div>

                </div>
                <div class="col-md-2 col-12">
                    <div class="total"><?= number_format($product->price * 1.196, 2, ',', ' '); ?> €</div>
                </div>

            </div>
        </div>
    <?php endforeach; ?>


    <div class="subtotal-area d-flex align-items-center justify-content-end">
        <div class="title text-uppercase" style="color: red; font-weight: bold;">GRAND TOTAL </div>
        <div class="subtotal"><?= number_format($panier->total(),2,',', '');?>€</div>
    </div>
    <div class="shipping-area d-flex justify-content-end">

</div>


<script src="js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/ion.rangeSlider.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
</body>

</html>
