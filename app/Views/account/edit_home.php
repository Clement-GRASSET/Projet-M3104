<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
$links = [
    ['url' => '/account/messages', 'name' => 'Messagerie'],
    ['url' => '/account/homes', 'name' => 'Mes annonces'],
    ['url' => '/account/settings', 'name' => 'Paramètres du compte'],
];
echo view('templates/dashboard_open', ['links' => $links]);
?>

<h1>Modifier <?= $annonce['A_titre'] ?></h1>

<p>Errors :</p>
<?php var_dump($errors); ?>

<form action="" method="post">

    <label for="titre">Titre de l'annonce</label><br/>
    <input type="text" name="titre" id="titre" value="<?= $annonce['A_titre'] ?>"><br/>

    <label for="loyer">Loyer</label><br/>
    <input type="number" step="0.01" name="loyer" id="loyer" value="<?= $annonce['A_cout_loyer'] ?>"><br/>

    <label for="charges">Charges</label><br/>
    <input type="number" step="0.01" name="charges" id="charges" value="<?= $annonce['A_cout_charges'] ?>"><br/>

    <label for="chauffage">Type de chauffage</label><br/>
    <select name="chauffage" id="chauffage">
        <option value="individuel" <?= (($annonce['A_type_chauffage'] === 'individuel') ? "selected" : "") ?>>Individuel</option>
        <option value="collectif" <?= (($annonce['A_type_chauffage'] === 'collectif') ? "selected" : "") ?>>Collectif</option>
    </select><br/>

    <label for="superficie">Superficie</label><br/>
    <input type="number" name="superficie" id="superficie" value="<?= $annonce['A_superficie'] ?>"><br/>

    <label for="description">Description</label><br/>
    <textarea name="description" id="description"><?= $annonce['A_description'] ?></textarea><br/>

    <label for="adresse">Adresse</label><br/>
    <input type="text" name="adresse" id="adresse" value="<?= $annonce['A_adresse'] ?>"><br/>

    <label for="ville">Ville</label><br/>
    <input type="text" name="ville" id="ville" value="<?= $annonce['A_ville'] ?>"><br/>

    <label for="cp">Code postal</label><br/>
    <input type="text" name="cp" id="cp" value="<?= $annonce['A_CP'] ?>"><br/>

    <label for="typeMaison">Type de maison</label><br/>
    <select name="typeMaison" id="typeMaison">
        <?php
        foreach ($typesMaison as $typeMaison) {
            echo "<option value='" . $typeMaison['T_type'] . "'" . (($annonce['A_type_maison'] === $typeMaison['T_type']) ? "selected" : "") .">" . $typeMaison['T_description'] . "</option>";
        }
        ?>
    </select><br/>

    <label for="typeEnergie">Type d'énergie</label><br/>
    <select name="typeEnergie" id="typeEnergie">
        <?php
        foreach ($energies as $energie) {
            echo "<option value='" . $energie['E_id_engie'] . "' " . (($annonce['A_id_engie'] === $energie['E_id_engie']) ? "selected" : "") . ">" . $energie['E_description'] . "</option>";
        }
        ?>
    </select><br/>

    <input class="button" type="submit" value="Modifier">

</form>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>
