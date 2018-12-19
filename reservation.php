<?php 
include 'inc/db.php';
include 'menu.php';
session_start();
?>

<div class="container">
<form action="action.php" method="POST" class="form-group" >
    <p>Votre nom : <input type="text" name="nom" class="form-control" required autofocus/></p>
    <p>Votre prenom : <input type="text" name="prenom" class="form-control" required/></p>
    <p>Votre email : <input type="email" name="email" class="form-control" required></p>
    <p>Telephone : <input type="text" name="tel" class="form-control" required></p>

    <p>debut réservation : </p><input type="datetime" name="date_reservation" class="form-control" required>
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
  <br>

    <p><input type="submit" value="validation" class="btn btn-primary"></p>
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