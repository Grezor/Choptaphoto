<?php
## Login 
require_once 'inc/db.php';
$DB = new DB();

if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
  
    // selectionne users 
    $req = $DB->requete('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL', ['username' => $_POST['username']]);
   
    $user = $req[0] == null;
    // Message d'erreur
    if($user == null){
        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
    }elseif(password_verify($_POST['password'], $user->password)){
        session_start();
        $_SESSION['auth'] = $user;
        $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
        header('Location: account.php');
        exit();
    }else{
        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
    }
}

             include "inc/header.php"
 ?>
    
    <section class="">
        <div class="container">
            <div class=" d-flex flex-wrap align-items-center">
                <div class="col-first">
                    <h1>CONNEXION </h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!-- Start My Account -->
    <div class="container">
        <br>
            <?php if (isset($_SESSION['flash'])): ?>
                <?php foreach ($_SESSION['flash'] as $type => $message): ?>
                    <div class="alert alert-<?= $type; ?>">
                        <?= $message; ?>
                    </div>
                <?php endforeach; ?>
                <?php unset($_SESSION['flash']); ?>
            <?php endif; ?>
<br>
            <div class="row">
            <div class="col-md-6">
                <div class="login-form">
                    <h3 class="billing-title text-center">Se connecter</h3>
                    <p class="text-center mt-80 mb-40">Bon retour parmi nous ! Connectez-vous à votre compte </p>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="">pseudo ou email</label>
                            <input type="text" name="username" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">mot de passe <a href="forget.php">Mot de passe oublié</a></label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
            <div class="login-form">
                <div class="">
                    <h3 class="billing-title text-center">Register</h3>
                    <p class="text-center mt-40 mb-30">Crée votre propre compte</p>

                    <a href="register.php"><button class="btn btn-lg btn-primary btn-block"><span>s'inscrire</span></button></a>

                </div>
            </div>
            </div>
        </div>
    </div>

<?php require 'inc/footer.php'; ?>

</body>

</html>
