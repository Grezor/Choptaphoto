<?php

class panier
{

    // function base de donnée
    private $DB;


    public function __construct($DB)
    {
    // initialiser la session
        if (!isset($_SESSION)) {
            session_start();
        }
        //PANIER
        if (!isset($_SESSION['panier'])) {
            // crée un panier vide
            $_SESSION['panier'] = array();
        }
        $this->DB = $DB;
    }
    // ajouter un produit au panier
    public function add_produit_panier($product_id)
    {
        // incrementation du produit selon l'id
        if (isset( $_SESSION['panier'][$product_id])){
            $_SESSION['panier'][$product_id]++;
        }else{
            $_SESSION['panier'][$product_id] = 1;
        }

    }
    // function calculer le prix total
    public function total(){
        $total=0;
        $ids = array_keys($_SESSION['panier']);
        if (empty($ids)) {
            $products = array();
        } else {
            $products = $this->DB->requete('SELECT id, price FROM products WHERE id IN (' . implode(',', $ids) . ')');
        }
        foreach ($products as $product){
            $total += $product->price* $_SESSION['panier'][$product->id];
        }
        return $total;
    }

    // supprime le produit du panier
    public function supprimer_produit($product_id)
    {
        unset($_SESSION['panier'][$product_id]);
    }

}