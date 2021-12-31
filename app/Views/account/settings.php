<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
$links = [
    ['url' => '/account/messages', 'name' => 'Messagerie'],
    ['url' => '/account/homes', 'name' => 'Mes annonces'],
    ['url' => '/account/settings', 'name' => 'Paramètres du compte'],
];
echo view('templates/dashboard_open', ['links' => $links]);
?>

<h1>Mon compte</h1>

<table>
    <tr>
        <td>Nom</td>
        <td><?=$user['U_nom']?></td>
    </tr>
    <tr>
        <td>Prénom</td>
        <td><?=$user['U_prenom']?></td>
    </tr>
    <tr>
        <td>Pseudo</td>
        <td><?=$user['U_pseudo']?></td>
    </tr>
    <tr>
        <td>Adresse email</td>
        <td><?=$user['U_mail']?></td>
    </tr>
</table>

<p><a href='<?= base_url('/account/settings/delete') ?>'>Supprimmer mon compte</a></p>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>
