<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
echo view('templates/html_navbar');
echo view('templates/dashboard_open');
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
