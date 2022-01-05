<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
echo view('templates/html_navbar');
echo view('templates/dashboard_open');
?>

<h1><?= $annonce['A_titre'] ?></h1>

<h2>Détails</h2>

<table>
    <tr>
        <td>Description</td>
        <td><?= $annonce['A_description'] ?></td>
    </tr>
    <tr>
        <td>Loyer</td>
        <td><?= $annonce['A_cout_loyer'] ?> €</td>
    </tr>
    <tr>
        <td>Charges</td>
        <td><?= $annonce['A_cout_charges'] ?> €</td>
    </tr>
    <tr>
        <td>Superficie</td>
        <td><?= $annonce['A_superficie'] ?> m²</td>
    </tr>
    <tr>
        <td>Type de chauffage</td>
        <td><?= $annonce['A_type_chauffage'] ?></td>
    </tr>
    <?php if (isset($annonce['A_energie'])) { ?>
        <tr>
            <td>Energie</td>
            <td><?= $annonce['A_energie'] ?></td>
        </tr>
    <?php } ?>
    <tr>
        <td>Type de maison</td>
        <td><?= $annonce['A_typeMaison'] ?></td>
    </tr>
    <tr>
        <td>Adresse</td>
        <td><?= $annonce['A_adresse'] ?></td>
    </tr>
    <tr>
        <td>Ville</td>
        <td><?= $annonce['A_ville'] ?></td>
    </tr>
    <tr>
        <td>Code postal</td>
        <td><?= $annonce['A_CP'] ?></td>
    </tr>
</table>

<div>
    <?php


    switch ($annonce['A_etat']) {

        case 'en cours de rédaction': {
            echo "<p>Cette annonce n'est pas publiée</p>";
            echo "<a class='button' href='" . base_url("/account/homes/".$annonce['A_idannonce']."/edit") . "'>Modifier</a> ";
            echo "<a class='button' href='" . base_url("/account/homes/".$annonce['A_idannonce']."/publish") . "'>Publier</a> ";
            echo "<a class='button' href='" . base_url("/account/homes/".$annonce['A_idannonce']."/delete") . "'>Supprimer</a>";
            break;
        }
        case 'publiée': {
            echo "<p>Cette annonce est publiée</p>";
            echo "<a class='button' href='" . base_url("/account/homes/".$annonce['A_idannonce']."/edit") . "'>Modifier</a> ";
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

if (!empty($annonce['A_photos'])) {

    echo '<h2>Photos</h2>';
    echo '<div class="photos">';
    foreach ($annonce['A_photos'] as $photo) {
        echo "<div class='photo'>
            <div class='title'>
                <p>" . $photo['P_titre'] . "</p>
                <a href='" . base_url('/account/homes/'.$annonce['A_idannonce'].'/delete_photo/'.$photo['P_id_photo']) . "'>Supprimer</a>
            </div>
            <img alt='' src='" . base_url('/images/homes/'.$annonce['A_idannonce'].'/'.$photo['P_nom']) ."'/>
            </div>";
    }
    echo '</div>';
}

?>

<h2>Ajouter une photo</h2>

<form action="" method="post" enctype="multipart/form-data">
    <label for="titre">Titre de l'image</label><br/>
    <input type="text" name="titre" id="titre"/><br/>
    <?= $errors->html('titre') ?>
    <label for="image">Ajouter une photo</label><br/>
    <input type="file" name="image" id="image" accept="image/png, image/jpeg"/><br/>
    <?= $errors->html('image') ?>
    <input class="button" type="submit" name="add_image" value="Ajouter">
</form>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>
