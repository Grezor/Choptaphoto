

<?php
include 'inc/db.php';




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

$newDate = date("Y-m-d", strtotime($ddr));
$newDate2 = date("Y-m-d", strtotime($ddr2));

var_dump($newDate, $newDate2);
?>

<?php 
   // :variable (evite injection sql)
   // value="');update test set date_reservation='2018-01-01';--"
try {

$insert_bdd = "INSERT INTO test (nom, prenom, email, tel, date_reservation, heure_reservation, date_fin_reservation, fin_reservation, produit)
VALUES (:nom, :prenom, :email, :tel,:ddr,:hre_reservation,:ddr2,:hrefin_reservation, :produit)";
   
    $stmt = $pdo->prepare($insert_bdd);
    $stmt->execute([
        ':nom'=>$nom,
        ':prenom'=>$prenom,
        ':email'=>$email,
        ':tel'=>$tel,
        ':ddr'=>$ddr,
        ':hre_reservation'=>$hre_reservation,
        ':ddr2'=>$ddr2,
        ':hrefin_reservation'=>$hrefin_reservation,
        ':produit'=>$produit,
    ]);
    // laisse un message a l'utilisateur
    echo "La reservation a bien étais enregistrer";
    }
    catch(PDOException $e)
    {
  echo $e->getMessage();
    }

$conn = null;

?>
<br>
<br>



