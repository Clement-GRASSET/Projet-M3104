<?= view('templates/html_open', ['styles' => ['homes.css', 'accueil.css'], 'fontAwesome' => true]) ?>
<?= view('templates/html_navbar.php') ?>

<section class="home" id="home">
    <form id="larger">

        <h1 id="center">Annonces</h1>

        <?php
        foreach ($annonces as $annonce) {
            ?>

            <a href='<?= base_url("/homes/" . $annonce['A_idannonce']) ?>' class="annonce">
                <img class="photo"
                     src="<?= base_url('/images/homes/' . ((empty($annonce['A_photos'])) ? 'default.png' : $annonce['A_idannonce'] . '/' . $annonce['A_photos'][0]['P_nom'])) ?>">
                <div class="infos">
                    <div>
                        <h2><?= $annonce['A_titre'] ?></h2>
                        <p><?= $annonce['A_description'] ?></p>
                    </div>
                    <div>
                        <h3>Détails de l'annonce</h3>
                        <table>
                            <tr>
                                <td>Loyer :</td>
                                <td><?= $annonce['A_cout_loyer'] ?> €</td>
                            </tr>
                            <tr>
                                <td>Charges :</td>
                                <td><?= $annonce['A_cout_charges'] ?> €</td>
                            </tr>
                            <tr>
                                <td>Type de maison :</td>
                                <td><?= $annonce['A_typeMaison'] ?></td>
                            </tr>
                        </table>
                        <h3>Propriétaire</h3>
                        <table>
                            <tr>
                                <td>Pseudo :</td>
                                <td><?= $annonce['A_proprietaire']['U_pseudo'] ?></td>
                            </tr>
                            <tr>
                                <td>Nom :</td>
                                <td><?= $annonce['A_proprietaire']['U_nom'] ?></td>
                            </tr>
                            <tr>
                                <td>Prénom :</td>
                                <td><?= $annonce['A_proprietaire']['U_prenom'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </a>

            <?php
        }
        ?>

        <div class="pages">
            <p>Pages :</p>
            <div class="page-list">
                <?php

                for ($i = 1; $i <= $nbPages; $i++) {
                    echo "<a " . (($i === $numPage) ? "class='active'" : "") . " href='" . base_url('/homes?page=' . $i) . "'>" . $i . "</a> ";
                }

                ?>
            </div>
        </div>
    </form>

</section>

<?= view('templates/html_close.php') ?>
