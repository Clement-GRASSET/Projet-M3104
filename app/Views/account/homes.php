<h1>Ici on met lis maisons di l'itilisateure</h1>

<p><a href="<?= base_url("/account/homes/add") ?>">Créer une annonce</a></p>

<h2>Mes annonces</h2>

<?php

foreach ($annonces as $annonce) {
    echo "<a href='" . base_url("/account/homes/" . $annonce['A_idannonce']) . "'>" . $annonce['A_titre'] . "</a>";
}

?>
