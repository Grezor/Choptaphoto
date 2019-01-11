<?php 
include 'inc/db.php';
//include 'menu.php';
session_start();
?>
<!DOCTYPE html>
<html lang="zxx">

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
                        <li class="nav-item">
                            <a class="nav-link" href="categorie.php">categorie</a>
                        </li>
                        <li class="nav-item active">
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

<div class="container">
<form action="action.php" method="POST" class="form-group" >
    <p>Votre nom : <input type="text" name="nom" class="form-control" required autofocus/></p>
    <p>Votre prenom : <input type="text" name="prenom" class="form-control" required/></p>
    <p>Votre email : <input type="email" name="email" class="form-control" required></p>
    <p>Telephone : <input type="text" name="tel" class="form-control" required></p>

    <p>debut réservation : </p><input type="datetime" name="date_reservation" class="form-control" required>
    <p>heure debut reservation : <input type="time" name="heure_reservation" required></p>

    <p>fin reservation : <input type="date" name="date_fin_reservation" class="form-control" required></p>
    <p>heure fin reservation : <input type="time" name="fin_reservation" required></p>

                    

   
<?php 
// Affiche les produits
$DB = new DB();
$select_consommable = "SELECT libelle FROM consommables";
$req_consommables = $DB->requete($select_consommable);
// execute la requete prepare
//$req_consommables->execute();
?>
 <select name="produit" class="form-control">
 <?php 
    // affiche tout les consommables, $req_consommables en parametre
    foreach ($req_consommables AS $consommables ) { ?>
        <option value="produit"><?php echo $consommables->libelle;?></option>
<?php
    }
?>
</select>
  <br>

    <p><input type="submit" value="validation" class="btn btn-primary"></p>
</form>

</div>

<!--<TABLE BORDER="5">

<tr>

<th> Nom </th>
<th> Stock </th>
<th> Prix </th>
<th> Description </th>
</tr>-->

<?php
try
{

// On recupere tout le contenu de la table news
$reponse = $DB->requete('SELECT libelle,stock,prix, description FROM consommables');
// donnée a vide
$donnees = '';
$count = 0;
  
// boucle while qui affiche le nombre donnee bdd
// affiche nombre de résultat dans la bdd
/*foreach ($reponse AS $donnees )
    {
        $count = $count +1;
    //On affiche les données dans le tableau
    echo "</tr>";
    echo "<td> $donnees->libelle </td>";
    echo "<td> $donnees->stock </td>";
    echo "<td> $donnees->prix"." € </td>" ;
    echo "<td> $donnees->description </td>";
    echo "</tr>";

    }*/
//$reponse->closeCursor();
// affiche le nombre d'enregistrement bdd
echo 'Il y a '.$count.' enregistrements dans la base de données 😂 .';
}
// affiche erreur 
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}
?>
 
</table> 

</body>
</html>