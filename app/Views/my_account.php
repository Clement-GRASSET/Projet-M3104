<?= view('templates/html_open.php') ?>

<?php var_dump($user); ?>

<h1>Mon compte</h1>

<table>
    <tr>
        <td>Nom</td>
        <td><?=$user["U_nom"]?></td>
    </tr>
    <tr>
        <td>Prénom</td>
        <td><?=$user["U_prenom"]?></td>
    </tr>
    <tr>
        <td>Pseudo</td>
        <td><?=$user["U_pseudo"]?></td>
    </tr>
    <tr>
        <td>Adresse email</td>
        <td><?=$user["U_mail"]?></td>
    </tr>
</table>

<p><a href="<?= base_url("/delete_account") ?>">Supprimmer mon compte</a></p>

<?= view('templates/html_close.php') ?>