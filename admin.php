<?php

session_start();
require 'inc/function.php';
require_once 'inc/header.php';
logged_only();
if($_SESSION['auth']->role != 'admin'){
    header('Location: login.php');
    exit();
}
if (!empty($_POST['role'])) {
    $role = $_POST['role'];
    $req = $pdo->prepare('UPDATE users SET role = ? WHERE id= ?')->execute([$role, $user_id]);
    $_SESSION['flash']['success'] = "Votre role a bien été mis a jour";
}

?>
<h1>page admin</h1>
<div class="form-group">
    <label for="role">Choisir le role</label>
    <select class="form-control" id="role" name="role">
        <option value="admin">admin</option>
        <option value="membre">jury</option>
    </select>
</div>

<button class="btn btn-primary"> mettre a jour</button>