<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
$links = [
    ['url' => '/admin/users', 'name' => 'Utilisateurs'],
    ['url' => '/admin/homes', 'name' => 'Annonces'],
];
$type = 'Admin Panel';
echo view('templates/dashboard_open', ['links' => $links, 'type' => $type]);
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

<?php

switch ($annonce['A_etat']) {

    case 'publiée': {
        echo "<a class='button' href='" . base_url('/admin/homes/'.$annonce['A_idannonce'].'/block') . "'>Bloquer l'annonce</a>";
        break;
    }
    case 'bloquée': {
        echo "<a class='button' href='" . base_url('/admin/homes/'.$annonce['A_idannonce'].'/unblock') . "'>Débloquer l'annonce</a>";
        break;
    }
}
echo "<a class='button' href='" . base_url('/admin/homes/'.$annonce['A_idannonce'].'/delete') . "'>Supprimer l'annonce</a>";

?>

<h2>Photos</h2>

<?php

if (empty($annonce['A_photos'])) {
    echo "<p>Aucune photo</p>";
} else {
    echo '<div class="photos">';
    foreach ($annonce['A_photos'] as $photo) {
        echo "<div class='photo'>
            <div class='title'>
                <p>" . $photo['P_titre'] . "</p>
                <a href='" . base_url('/admin/homes/'.$annonce['A_idannonce'].'/delete_photo/'.$photo['P_id_photo']) . "'>Supprimer</a>
            </div>
            <img alt='' src='" . base_url('/images/homes/'.$annonce['A_idannonce'].'/'.$photo['P_nom']) ."'/>
            </div>";
    }
    echo '</div>';
}

?>

<h2>Messages</h2>

<?php

if (empty($discussions)) {
    echo "<p>Aucun nouveau message</p>";
}

foreach ($discussions as $discussion) {
    echo "<p>" . $discussion['D_utilisateur'] . "<a class='button' href='" . base_url('/admin/homes/'.$annonce['A_idannonce'].'/messages/'.$discussion['D_utilisateur']) . "'>Supprimmer</a>" . "</p>";
}

?>


<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>