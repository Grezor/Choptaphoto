<?php
require_once 'inc/db.php';
require_once 'paniers.class.php';
$DB = new DB();
$panier = new panier($DB);