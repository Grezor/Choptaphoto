<?php 
require_once 'header.php';
require_once 'inc/db.php';
?>


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
