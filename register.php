<?php require_once 'inc/function.php'; ?>
<?php session_start(); ?>
<?php

if (!empty($_POST)) {
    $errors = array();
    require_once 'inc/db.php';
    $DB = new DB();
    //==============================================================
    //       Vérification Username
    //==============================================================
    if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
        $errors['username'] = "Votre pseudo n'est pas valide alphanumérique";
    } else {
        $req = $DB->requete('SELECT id FROM users WHERE username = ?', [$_POST['username']]);
       
        $user = $req[0] ?? null;
        if ($user ) {
            $errors['username'] = 'ce pseudo est deja pris';
        }
    }
    //==============================================================
    //       Vérification adresse email
    //==============================================================
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Vous n'avez pas entrer d'email valide";
    } else {
        $req = $DB->requete('SELECT id FROM users WHERE email = ?',[$_POST['email']]);
        $user = $req[0] ?? null;
        if ($user) {
            $errors['email'] = 'ce email est deja pris';
        }
    }
    //==============================================================
    //       Vérification Mot de passe
    //==============================================================

    if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
        $errors['password'] = "Vous ndevez entrer un mot de passe valide";
    }
    //==============================================================
    //       Affiche les erreurs
    //==============================================================
    if (empty($errors)) {
        // taille de la clé génerer par mail, ici 60 caractère avec un hash mot de passe
        $token = str_random(60);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $req = $DB->requete("INSERT INTO users SET username = ?, password = ?, email= ?, confirmation_token = ?",[$_POST['username'], $password, $_POST['email'], $token] );
        
        debug($token);

        $user_id = $DB->getDB()->lastInsertId();
        mail($_POST['email'], 'Confirmation de votre compte', "afin de valider de valider votre compte, merci de cliquer sur le lien \n\n http://localhost/gestion_membre/confirm.php?id=$user_id&token=$token");
        $_SESSION['flash']['success'] = "un email de confirmation vous avez etais envoyé pour valider votre compte";
        header('Location: login.php');
        exit();
    }
}
?>

<?php require 'inc/header.php'; ?>
    <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet"> 
<h1>s'inscrire</h1>
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
        <label for="">pseudo</label>
        <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="">email</label>
        <input type="text" name="email" class="form-control">
    </div>


    <div class="form-group">
        <label for="">mot de passe</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Confirme votre mot de passe</label>
        <input type="password" name="password_confirm" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">M'inscrire</button>
</form>
