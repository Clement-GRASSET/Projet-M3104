<?= view('templates/html_open.php') ?>

<h1>Ici on met lis maisons</h1>

<p>Annonces :</p>

<?php

foreach ($annonces as $annonce) {
    echo "<a href='" . base_url("/homes/" . $annonce['A_idannonce']) . "'>" . $annonce['A_titre'] . "</a>";
}

?>

<?= view('templates/html_close.php') ?>
