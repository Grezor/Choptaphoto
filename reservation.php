<?php 
include 'inc/db.php';
include 'menu.php';
session_start();


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <title>Document</title>
</head>
<body>
<div class="container">
<form action="action.php" method="POST" class="form-group" >
    <p>Votre nom : <input type="text" name="nom" class="form-control" required autofocus/></p>
    <p>Votre prenom : <input type="text" name="prenom" class="form-control" required/></p>
    <p>Votre email : <input type="email" name="email" class="form-control" required></p>
    <p>Telephone : <input type="text" name="tel" class="form-control" required></p>

    <p>debut réservation : </p><input type="date" name="date_reservation" class="form-control" required>
    <p>heure debut reservation : <input type="time" name="heure_reservation" required></p>

    <p>fin reservation : <input type="date" name="date_fin_reservation" class="form-control" required>
    heure fin reservation : <input type="time" name="fin_reservation" required></p>
   
    <?php 
// Affiche les produits
$select_consommable = "SELECT nom FROM consommables";
$req_consommables = $pdo->prepare($select_consommable);
// execute la requete prepare
$req_consommables->execute();
?>
 <select name="produit" class="form-control">
 <?php 
    // affiche tout les consommables, $req_consommables en parametre
    while ($consommables = $req_consommables->fetch()) { ?>
        <option value="produit"><?php echo "$consommables[nom]";?></option>
    <?php
    }
    ?>
</select>
  

    <p><input type="submit" value="validation"></p>
</form>



</div>


<TABLE BORDER="5">

<tr>

<th> Nom </th>
<th> Stock </th>
<th> Prix </th>
<th> Description </th>
</tr>

<?php
try
{
    // connexion bdd
 // $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
//  $bdd = new PDO('mysql:host=localhost;dbname=ppe2v2', 'root', '', $pdo_options);
   
   
// On recupere tout le contenu de la table news
$reponse = $pdo->query('SELECT nom,stock,prix, description FROM consommables');
// donnée a vide
$donnees = '';
$count = 0;

  
// boucle while qui affiche le nombre donnee bdd
// affiche nombre de résultat dans la bdd
while ($donnees = $reponse->fetch())
    {
        $count = $count +1;
    //On affiche les données dans le tableau
    echo "</tr>";
    echo "<td> $donnees[nom] </td>";
    echo "<td> $donnees[stock] </td>";
    echo "<td> $donnees[prix]"." € </td>" ;
    echo "<td> $donnees[description] </td>";
    echo "</tr>";

    }
$reponse->closeCursor();
// affiche le nombre d'enregistrement bdd
echo 'Il y a '.$count.' enregistrements dans la base de données 😂 .';
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}
?>
 
</table> 

</body>
</html>