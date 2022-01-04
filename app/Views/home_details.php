<?= view('templates/html_open', ['styles'=>['homes.css'], 'fontAwesome'=>true]) ?>
<?= view('templates/html_navbar.php') ?>

<div class="content">

    <h1><?= $annonce['A_titre'] ?></h1>

    <?php
    if ($isLoggedIn) {
        if ($annonce['A_proprietaire']['U_mail'] === $loggedUser['U_mail']) {
    ?>
            <p>Vous visualisez une de vos annonces</p>
            <a class="btn" href="<?= base_url('account/homes/'.$annonce['A_idannonce']) ?>">Voir l'annonce dans mon espace personnel</a>
    <?php
        }
    }
    ?>

    <h2>Photos</h2>
    <a class="photo" <?= (empty($annonce['A_photos'])) ? '' : 'href="'.base_url('/homes/'.$annonce['A_idannonce'].'/photo?id='.$annonce['A_photos'][0]['P_id_photo']).'"' ?>>
        <img src="<?= (empty($annonce['A_photos']) ? base_url('/images/homes/default.png') : base_url('/images/homes/'.$annonce['A_idannonce'].'/'.$annonce['A_photos'][0]['P_nom'])) ?>" alt="Photo">
    </a>

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

    <h2>Propriétaire</h2>
    <table>
        <tr>
            <td>Pseudo</td>
            <td><?= $annonce['A_proprietaire']['U_pseudo'] ?></td>
        </tr>
        <tr>
            <td>Nom</td>
            <td><?= $annonce['A_proprietaire']['U_nom'] ?></td>
        </tr>
        <tr>
            <td>Prénom</td>
            <td><?= $annonce['A_proprietaire']['U_prenom'] ?></td>
        </tr>
    </table>

    <?php
    if ($isLoggedIn && $annonce['A_proprietaire']['U_mail'] !== $loggedUser['U_mail']) {
        ?>
        <a class="btn" href="<?= base_url("/homes/" . $annonce['A_idannonce'] . "/contact") ?>">Contacter le propriétaire</a>
        <?php
    }
    ?>

</div>



<?= view('templates/html_close.php') ?>
