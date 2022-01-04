<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
$links = [
    ['url' => '/admin/users', 'name' => 'Utilisateurs'],
    ['url' => '/admin/homes', 'name' => 'Annonces'],
];
$type = 'Admin Panel';
echo view('templates/dashboard_open', ['links' => $links, 'type' => $type]);
?>

<h1>Bloquer <?= $annonce['A_titre'] ?></h1>

<p>Confirmer le blocage de l'annonce</p>
<form action="" method="post">
    <input class="button" type="submit" name="confirm" value="Confirmer">
</form>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>
