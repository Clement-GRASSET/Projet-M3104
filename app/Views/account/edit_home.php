<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
$links = [
    ['url' => '/account/messages', 'name' => 'Messagerie'],
    ['url' => '/account/homes', 'name' => 'Mes annonces'],
    ['url' => '/account/settings', 'name' => 'Paramètres du compte'],
];
echo view('templates/dashboard_open', ['links' => $links]);
?>

<h1>Editer une annonce</h1>

<?php
var_dump($annonce);
?>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>
