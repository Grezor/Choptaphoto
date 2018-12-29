<?php

require '_header.php';

// recupere les produits

// verifie si l'id exsite .
if (isset($_GET['id'])) {
    $product = $DB->requete('SELECT id FROM products WHERE id=:id', array('id' => $_GET['id']));
//   Si le produit n'existe pas
    if (empty($product)){
        die("ce produit n'existe pas");
    }
    $panier->add_produit_panier($product[0]->id);
    die('le produit à bien été ajouté à votre panier, <a href="javascript:history.back()">retourner sur le panier</a>  ');
} else {
    die("vous n'avez pas séléctionné de produit a ajouter");
}

?>
