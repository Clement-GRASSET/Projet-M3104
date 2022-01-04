<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
echo view('templates/html_navbar');
$links = [
    ['url' => '/account/messages', 'name' => 'Messagerie'],
    ['url' => '/account/homes', 'name' => 'Mes annonces'],
    ['url' => '/account/settings', 'name' => 'Paramètres du compte'],
];
$type = 'Mon Compte';
echo view('templates/dashboard_open', ['links' => $links, 'type' => $type]);
?>

    <h1>Archiver <?= $annonce['A_titre'] ?></h1>

    <p>Confirmer l'archivage de l'annonce</p>
    <p>Cette action est irréversible</p>
    <form action="" method="post">
        <input class="button" type="submit" name="confirm" value="Confirmer">
    </form>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>