<?php 
include 'header.php';
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
<section class="banner-sec-w3layouts" id="home">
        <!-- header -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light top-header">
                <div class="logo text-center">
                    <h1 class="logo">
                        <a class="navbar-brand" href="index.html">
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
                        <li class="nav-item">
                            <a class="nav-link ml-lg-0" href="index.php">Acceuil
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="categorie.php">categorie</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reservation.php">Reservation</a>
                        </li>

                        
                        <li class="nav-item">
                            <a class="nav-link" href="panier.php">Panier</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link scroll" href="index.html">Contact</a>
                        </li>
                        <li class="search">
                            <a class="play-icon popup-with-zoom-anim" href="#small-dialog">
                                <i class="fas fa-search"></i>
                            </a>
                            <div id="small-dialog" class="mfp-hide">
                                <div class="search-top">
                                    <div class="search-inn">
                                        <form action="#" method="post" class="disply-flex">
                                            <input class="form-control" type="search" name="search" value="recherche..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}">
                                            <button class="btn2">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <p>Photo mobile</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="phone-inline my-2 my-lg-0">

                    <h6>
                        <span class="fas fa-phone"></span> 03 04 05 06 07 </h6>
                </div>

            </nav>
        </header>


    <!-- Start Header Area -->

    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8 col-md-7">
                
                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">
                        <?php $products = $DB->requete('SELECT * FROM bornes, consommable')?>
                        <?php foreach ( $products as $product):?>

                            <div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
                                <div class="content">
                                    <div class="content-overlay"></div>
                                    <img class="content-image img-fluid d-block mx-auto" src="images/<?= $product->id; ?>" alt="">
                                    <div class="content-details fadeIn-bottom">
                                        <div class="bottom d-flex align-items-center justify-content-center">
                                            <a class="addPanier" href="addpanier.php?id=<?= $product->id; ?>"><i class="fa fa-shopping-cart"></i></a>
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
require 'inc/footer.php';
?>
  
</body>

</html>
