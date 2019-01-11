<?php
require 'paniers.class.php';
//require 'inc/header.php';
include 'header.php';
$DB = new DB();
$panier = new panier($DB);

?>

<head>
    <title>Photo mobile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Shoot a Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script>
        addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/owl.theme.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Tajawal:200,300,400,500,700,800,900" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
</head>

<body>
    <!-- /banner -->
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
        </header>

<body>
<form action="panier.php" method="post">

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

    foreach ($products as $product): ?>


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
<!--                         quantite du produit-->
                        <input type="text" class="quantity-amount" name="panier[quantity][<?= $product->id; ?>]" value="<?= $_SESSION['panier'][$product->id]?>"/>

                        <a href="panier.php?delPanier=<?= $product->id; ?>" class="increase arrow" type="button" title="Increase Quantity"><i class="fa fa-close"></i></a>
                    </div>

                </div>
                <div class="col-md-2 col-12">
                    <div class="total"><?= number_format($product->price * 1.2, 2, ',', ' '); ?> €</div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

            <input type="submit" value="recalculer">
    <div class="subtotal-area d-flex align-items-center justify-content-end">

        <div class="title text-uppercase" style="color: red; font-weight: bold;">GRAND TOTAL </div>
        <div class="subtotal"><?= number_format($panier->total() * 1.2,2,',', '');?>€</div>
    </div>

        <div class="subtotal-area d-flex align-items-center justify-content-end">
            <div class="title text-uppercase" style="color: red; font-weight: bold;">Nombre d'element </div>
            <div class="subtotal"><?= $panier->count();?></div>
        </div>
</div>
</form>
<?php
require 'inc/footer.php';
?>
<script
        src="https://code.jquery.com/jquery-1.7.2.min.js"
        integrity="sha256-R7aNzoy2gFrVs+pNJ6+SokH04ppcEqJ0yFLkNGoFALQ="
        crossorigin="anonymous"></script>
<script src="js/app.js"></script>




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
