<?= view('templates/html_open', ['styles' => ['accueil.css', 'homes.css'], 'fontAwesome' => true]) ?>
<?= view('templates/html_navbar.php') ?>

<div class="home" id="home">
    <div class="annonces">

        <h1 id="center">Annonces</h1>

        <form action="" method="get" class="search">

            <label>Ville</label><br/>
            <input type="text" name="ville" value="<?= $filter['A_ville'] ?? '' ?>"><br/>

            <label>Adresse</label><br/>
            <input type="text" name="adresse" value="<?= $filter['A_adresse'] ?? '' ?>"><br/>

            <label>Type de maison</label><br/>
            <select name="type_maison">
                <option value="">Selectionner</option>
                <?php
                foreach ($typesMaison as $typeMaison) {
                    echo "<option value='" . $typeMaison['T_type'] . "'" . ((isset($filter['A_type_maison']) && $filter['A_type_maison'] === $typeMaison['T_type']) ? 'selected' : '') .">" . $typeMaison['T_description'] . "</option>";
                }
                ?>
            </select><br/>

            <label>Type de chuaffage</label><br/>
            <select name="type_chauffage">
                <option value="">Selectionner</option>
                <option value="individuel" <?= (isset($filter['A_type_chauffage']) && $filter['A_type_chauffage'] === 'individuel') ? 'selected' : ''?>>Individuel</option>
                <option value="collectif" <?= (isset($filter['A_type_chauffage']) && $filter['A_type_chauffage'] === 'collectif') ? 'selected' : ''?>>Collectif</option>
            </select><br/>

            <input type="submit" value="Rechercher">
        </form>

        <?php
        foreach ($annonces as $annonce) {
            ?>

            <a href='<?= base_url("/homes/" . $annonce['A_idannonce']) ?>' class="annonce">
                <img class="photo"
                     src="<?= base_url('/images/homes/' . ((empty($annonce['A_photos'])) ? 'default.png' : $annonce['A_idannonce'] . '/' . $annonce['A_photos'][0]['P_nom'])) ?>">
                <div class="infos">
                    <div>
                        <h2><?= $annonce['A_titre'] ?></h2>
                        <?= ($isLoggedIn && $annonce['A_proprietaire']['U_mail'] === $loggedUser['U_mail']) ? "<p>Cette annonce vous appartient</p><br/>" : "" ?>
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
                $params = '';
                if (isset($filter['A_ville'])) $params = $params . '&ville=' . $filter['A_ville'];
                if (isset($filter['A_adresse'])) $params = $params . '&adresse=' . $filter['A_adresse'];
                if (isset($filter['A_type_maison'])) $params = $params . '&type_chauffage=' . $filter['A_type_maison'];
                if (isset($filter['A_type_chauffage'])) $params = $params . '&type_chauffage=' . $filter['A_type_chauffage'];

                for ($i = 1; $i <= $nbPages; $i++) {
                    echo "<a " . (($i === $numPage) ? "class='active'" : "") . " href='" . base_url('/homes?page=' . $i . $params) . "'>" . $i . "</a> ";
                }

                ?>
            </div>
        </div>
    </div>

</div>

<?= view('templates/html_close.php') ?>
