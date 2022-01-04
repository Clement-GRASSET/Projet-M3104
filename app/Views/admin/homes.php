<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
echo view('templates/html_navbar');
echo view('templates/dashboard_open');
?>

<h1>Li maisons</h1>



<?php

if (!empty($annonces_bloquées))
    echo "<h2>Annonces bloquées</h2>";

foreach ($annonces_bloquées as $annonce) {
    echo "<a class='link' href='" . base_url("/admin/homes/" . $annonce['A_idannonce']) . "'>" . $annonce['A_titre'] . "</a>";
}

if (!empty($annonces_publiées))
    echo "<h2>Annonces publiées</h2>";

foreach ($annonces_publiées as $annonce) {
    echo "<a class='link' href='" . base_url("/admin/homes/" . $annonce['A_idannonce']) . "'>" . $annonce['A_titre'] . "</a>";
}

if (!empty($annonces_archivées))
    echo "<h2>Annonces archivées</h2>";

foreach ($annonces_archivées as $annonce) {
    echo "<a class='link' href='" . base_url("/admin/homes/" . $annonce['A_idannonce']) . "'>" . $annonce['A_titre'] . "</a>";
}

?>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>
