<?php

class panier
{

    // initialise la connexion
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

        // supprimer le panier
        if (isset($_GET['delPanier'])) {
            $this->del($_GET['delPanier']);
        }
        if (isset($_POST['panier']['quantity'])) {
            $this->recalc();
        }
    }

    public function recalc()
    {
        foreach ($_SESSION['panier'] as $product_id => $quantity) {
            if (isset($_POST['panier']['quantity'][$product_id])) {
                $_SESSION['panier'][$product_id] = $_POST['panier']['quantity'][$product_id];
            }
        }

    }

    /*============================================================================
    > CALCULE LE NOMBRE DE PRODUIT DANS LE PANIER
    Calcule la somme des valeurs du tableau
    =============================================================================*/
    public function count()
    {
        return array_sum($_SESSION['panier']);
    }

    /*============================================================================
    > TOTAL
    =============================================================================*/
    public function total()
    {
        $total = 0;
        $ids = array_keys($_SESSION['panier']);
        if (empty($ids)) {
            $products = array();
        } else {
            $products = $this->DB->requete('SELECT id, price FROM products WHERE id IN (' . implode(',', $ids) . ')');
        }

        foreach ($products as $product) {
            // avoir le total, avec le nombre de quantite entrer

            $total += $product->price * $_SESSION['panier'][$product->id];
        }
        return $total;
    }

    /*============================================================================
    > AJOUTE UN PRODUIT AU PANIER
    =============================================================================*/
    public function add($product_id)
    {
        // incrementation du produit selon l'id
        if (isset($_SESSION['panier'][$product_id])) {
            $_SESSION['panier'][$product_id]++;
        } else {
            $_SESSION['panier'][$product_id] = 1;
        }
    }

    /*============================================================================
    > SUPPRIME UN PRODUIT DU PANIER
    =============================================================================*/
    public function del($product_id)
    {
        unset($_SESSION['panier'][$product_id]);
        
    }

}