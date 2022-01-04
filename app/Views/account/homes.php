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

<h1>Mes annonces</h1>

<p><a class="link accent" href="<?= base_url("/account/homes/add") ?>">Créer une annonce</a></p>

<?php

foreach ($annonces as $annonce) {
    echo "<a class='link' href='" . base_url("/account/homes/" . $annonce['A_idannonce']) . "'>" . $annonce['A_titre'] . "</a>";
}

?>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>
