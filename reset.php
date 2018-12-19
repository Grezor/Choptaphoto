<?php
if(isset($_GET['id']) && isset($_GET['token'])){
    require 'inc/db.php';
    require 'inc/function.php';
    $req = $pdo->prepare('SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
    $req->execute([$_GET['id'], $_GET['token']]);
    // on recupere les resultats
    $user = $req->fetch();
    // si on a un utilisateur on continue
    if($user){
        // des données on etais poser,
        // verification des deux mot de passe,
        // et en plus password confirm
        if(!empty($_POST)){
            if(!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']){
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $pdo->prepare('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL')->execute([$password]);
                session_start();
                $_SESSION['flash']['success'] = 'Votre mot de passe a bien été modifié';
                // connexion automatique
                $_SESSION['auth'] = $user;
                // redirection
                header('Location: account.php');
                exit();
            }
        }
    }else{
        session_start();
        $_SESSION['flash']['error'] = "Ce token n'est pas valide";
        header('Location: login.php');
        exit();
    }
}else{
    header('Location: login.php');
    exit();
}

?>
<?php require 'inc/header.php'; ?>
<h1>Reinitialiser mon mot de passe</h1>


<?php

if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <p>Vous n'avez pas rempli le formulaire correctement</p>
        <?php foreach ($errors as $error): ?>
            <ul>
                <li><?= $error; ?></li>
            </ul>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


<form action="" method="post">


    <div class="form-group">
        <label for="">mot de passe </label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="form-group">
        <label for="">confirmation du mot de passe </label>
        <input type="password" name="password_confirm" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">reinitialiser votre mot de passe</button>
</form>
<?php require 'inc/footer.php'; ?>


