<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
$links = [
    ['url' => '/account/messages', 'name' => 'Messagerie'],
    ['url' => '/account/homes', 'name' => 'Mes annonces'],
    ['url' => '/account/settings', 'name' => 'Paramètres du compte'],
];
echo view('templates/dashboard_open', ['links' => $links]);
?>

<h1><?= $annonce['A_titre'] ?></h1>

<?php
var_dump($annonce);
?>

<div>
    <?php


    switch ($annonce['A_etat']) {

        case 'en cours de rédaction': {
            echo "<p>Cette annonce n'est pas publiée</p>";
            echo "<a class='button' href='" . base_url("/account/homes/".$annonce['A_idannonce']."/edit") . "'>Modifier</a>";
            echo "<a class='button' href='" . base_url("/account/homes/".$annonce['A_idannonce']."/publish") . "'>Publier</a>";
            echo "<a class='button' href='" . base_url("/account/homes/".$annonce['A_idannonce']."/delete") . "'>Supprimer</a>";
            break;
        }
        case 'publiée': {
            echo "<p>Cette annonce est publiée</p>";
            echo "<a class='button' href='" . base_url("/account/homes/".$annonce['A_idannonce']."/edit") . "'>Modifier</a>";
            echo "<a class='button' href='" . base_url("/account/homes/".$annonce['A_idannonce']."/archive") . "'>Archiver</a>";
            break;
        }
        case 'bloquée': {
            echo "<p>Cette annonce a été bloquée par un administrateur</p>";
            echo "<a class='button' href='" . base_url("/account/homes/".$annonce['A_idannonce']."/edit") . "'>Modifier</a>";
            break;
        }
        case 'archivée': {
            echo "<p>Cette annonce est archivée</p>";
            break;
        }

    }

    ?>
</div>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>
