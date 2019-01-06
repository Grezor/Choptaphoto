<?php
require 'header.php';
$json = array('error' => true);
// recupere les produits

// verifie si l'id exsite .
if (isset($_GET['id'])) {
    $product = $DB->requete('SELECT id FROM products WHERE id=:id', array('id' => $_GET['id']));
//   Si le produit n'existe pas
    if (empty($product)) {
        $json['message'] = "ce produit n'existe pas";
    }
     $panier->add($product[0]->id);
    $json['error'] = false;
    $json['total'] = $panier->total();
    $json['count'] = $panier->count();
    $json['message']= "le produit à bien été ajouté à votre panier";
    
} else {
    $json['message']= "vous n avez pas séléctionné de produit a ajouter";
   
}

echo json_encode($json);