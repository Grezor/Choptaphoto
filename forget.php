<?php
//==============================================================
//       Mot de passe oublier
//==============================================================

# Envoye un mail de changement de mot de passe,
# Il selectionne l'adresse mail de l'utilisateurs
# Puis génére un token pour reinitialiser sont mot de passe.
# La personne clic sur le mail, pour acceder a la page reset mot de passe
# La personne est rediriger vers sont compte
# Affiche les messages d'erreurs


if (!empty($_POST) && !empty($_POST['email'])) {
    require_once 'inc/db.php';
    require_once 'inc/function.php';
    $req = $pdo->prepare('SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL');
    $req->execute([$_POST['email']]);

    if ($user = $req->fetch()) {
        session_start();
        // generer un nouveaux token
        $reset_token = str_random(60);
        $pdo->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user->id]);
        $_SESSION['flash']['success'] = 'Les instructions du rappel de mot de passe vous ont été envoyées par emails';
        mail($_POST['email'], 'Reinitiatilisation de votre mot de passe', "Afin de réinitialiser votre mot de passe merci de cliquer sur ce lien\n\nhttp://localhost/shop/reset.php?id={$user->id}&token=$reset_token");
        header('Location: login.php');
        exit();
    } else {
        $_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cet adresse';
    }
}
?>
<link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">
<?php require 'inc/header.php'; ?>
<h1>Mot de passe oublier</h1>


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


<form action="" class="form-signin" method="post">
    <div class="form-group">
        <label for="">email</label>
        <input type="email" name="email" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>
<?php //require 'inc/footer.php'; ?>
