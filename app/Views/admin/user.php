<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
echo view('templates/html_navbar');
echo view('templates/dashboard_open');
?>

<h1><?= $user['U_mail'] ?></h1>

<a class="button" href="<?= base_url('/admin/users/' . $user['U_mail'] . '/mail') ?>">Envoyer un mail</a>

<h2>Modifier l'utilisateur</h2>

<form action="" method="post">

    <label for="pseudo">Pseudo</label><br/>
    <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" value="<?= $user['U_pseudo'] ?>"><br/>

    <label for="nom">Nom</label><br/>
    <input type="text" id="nom" name="nom" placeholder="Nom" value="<?= $user['U_nom'] ?>"><br/>

    <label for="prenom">Prénom</label><br/>
    <input type="text" id="prenom" name="prenom" placeholder="Prénom" value="<?= $user['U_prenom'] ?>"><br/>

    <label for="admin">Administrateur</label>
    <input type="checkbox" id="admin" name="admin" <?= ($user['U_admin']) ? "checked" : "" ?> <?= ($me) ? "disabled" : "" ?>><br/>
    <?= ($me) ? "<p class='warning'>Vous ne pouvez pas vous retirer les droits administrateur</p>" : "" ?>

    <input class="button" type="submit" value="Modifier" name="update">

</form>

<a class="button" href=" <?= base_url('/admin/users/' . $user['U_mail'] . '/block') ?> ">Bloquer toutes les annonces</a>
<a class="button" href=" <?= base_url('/admin/users/' . $user['U_mail'] . '/unblock') ?> ">Débloquer toutes les annonces</a>
<br/><br/>

<?= ($me) ?
    "<p class='warning'>Vous ne pouvez pas supprimer votre propre compte</p>" :
    '<a class="button" href="' . base_url('/admin/users/' . $user['U_mail'] . '/delete') . '">Supprimer l\'utilisateur</a>'
?>


<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>