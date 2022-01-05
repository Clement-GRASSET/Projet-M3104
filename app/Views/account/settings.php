<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
echo view('templates/html_navbar');
echo view('templates/dashboard_open');
?>

<h1>Paramètres du compte</h1>

<h2>Modifier mes informations</h2>

<form action="" method="post">

    <label for="email">Adresse email</label><br/>
    <input type="email" id="email" name="email" value="<?=$user['U_mail']?>" disabled><br/>
    <?= $errors->html('email') ?>

    <label for="pseudo">Pseudo</label><br/>
    <input type="text" id="pseudo" name="pseudo" value="<?=$user['U_pseudo']?>"><br/>
    <?= $errors->html('pseudo') ?>

    <label for="nom">Nom</label><br/>
    <input type="text" id="nom" name="nom" value="<?=$user['U_nom']?>"><br/>
    <?= $errors->html('nom') ?>

    <label for="prenom">Prénom</label><br/>
    <input type="text" id="prenom" name="prenom" value="<?=$user['U_prenom']?>"><br/>
    <?= $errors->html('prenom') ?>

    <input type="submit" value="Modifier" class="button" name="update">

</form>

<h2>Modifier mon mot de passe</h2>

<form action="" method="post">

    <label for="password_new1">Nouveau mot de passe</label><br/>
    <input type="password" id="password_new1" name="password_new1"><br/>
    <?= $errors->html('password_new1') ?>

    <label for="password_new2">Confirmer le nouveau mot de passe</label><br/>
    <input type="password" id="password_new2" name="password_new2"><br/>
    <?= $errors->html('password_new2') ?>

    <input type="submit" value="Modifier" class="button" name="update_password">

</form>

<?php if ($user['U_admin'])
    echo "<p class='warning'>Vous ne pouvez pas supprimer votre compte car vous êtes administrateur</p>";
else
    echo "<a class='button' href='" . base_url('/account/settings/delete') . "'>Supprimmer mon compte</a>";
?>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>
