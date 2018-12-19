

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ppe2v2";
$e = "erreur bdd";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// verification connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// verification des champs

if (isset($_POST['nom'], $_POST['prenom']) && $_POST['nom'] != ""){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];

    $ddr = $_POST['date_reservation'];
    $hre_reservation = $_POST['heure_reservation'];

    $ddr2 = $_POST['date_fin_reservation'];
    $hrefin_reservation = $_POST['fin_reservation'];
    
    $produit = $_POST['produit'];
  
}
// definir la date en francais dans la base de donnée 


//echo $sql = "INSERT INTO test VALUES('$nom','$prenom','$email','$tel','$debut_reservation','$fin_reservation', '$produit')";
?>

<?php 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // on insert les donnée en bdd
   
     $sql = "INSERT INTO test (nom, prenom, email, tel, date_reservation, heure_reservation, date_fin_reservation, fin_reservation, produit )
             VALUES ('$nom', '$prenom', '$email', '$tel','$ddr','$hre_reservation','$ddr2','$hrefin_reservation', '$produit')";
    // use exec() because no results are returned
    $conn->exec($sql);
    // laisse un message a l'utilisateur
    echo "La reservation a bien étais enregistrer";
    }
    catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>
<br>
<br>



