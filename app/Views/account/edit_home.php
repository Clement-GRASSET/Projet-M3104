<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
$links = [
    ['url' => '/account/messages', 'name' => 'Messagerie'],
    ['url' => '/account/homes', 'name' => 'Mes annonces'],
    ['url' => '/account/settings', 'name' => 'Paramètres du compte'],
];
$type = 'Mon Compte';
echo view('templates/dashboard_open', ['links' => $links, 'type' => $type]);
?>

<h1>Modifier <?= $annonce['A_titre'] ?></h1>

<form action="" method="post">

    <label for="titre">Titre de l'annonce</label><br/>
    <input type="text" name="titre" id="titre" value="<?= $annonce['A_titre'] ?>"><br/>
    <?= $errors->html('titre') ?>

    <label for="loyer">Loyer</label><br/>
    <input type="number" step="0.01" name="loyer" id="loyer" value="<?= $annonce['A_cout_loyer'] ?>"><br/>
    <?= $errors->html('loyer') ?>

    <label for="charges">Charges</label><br/>
    <input type="number" step="0.01" name="charges" id="charges" value="<?= $annonce['A_cout_charges'] ?>"><br/>
    <?= $errors->html('charges') ?>

    <label for="chauffage">Type de chauffage</label><br/>
    <select name="chauffage" id="chauffage" onchange="select_chauffage_changed()">
        <option value="individuel" <?= (($annonce['A_type_chauffage'] === 'individuel') ? "selected" : "") ?>>Individuel</option>
        <option value="collectif" <?= (($annonce['A_type_chauffage'] === 'collectif') ? "selected" : "") ?>>Collectif</option>
    </select><br/>
    <?= $errors->html('chauffage') ?>

    <label for="superficie">Superficie</label><br/>
    <input type="number" name="superficie" id="superficie" value="<?= $annonce['A_superficie'] ?>"><br/>
    <?= $errors->html('superficie') ?>

    <label for="description">Description</label><br/>
    <textarea name="description" id="description"><?= $annonce['A_description'] ?></textarea><br/>
    <?= $errors->html('description') ?>

    <label for="adresse">Adresse</label><br/>
    <input type="text" name="adresse" id="adresse" value="<?= $annonce['A_adresse'] ?>"><br/>
    <?= $errors->html('adresse') ?>

    <label for="ville">Ville</label><br/>
    <input type="text" name="ville" id="ville" value="<?= $annonce['A_ville'] ?>"><br/>
    <?= $errors->html('ville') ?>

    <label for="cp">Code postal</label><br/>
    <input type="text" name="cp" id="cp" value="<?= $annonce['A_CP'] ?>"><br/>
    <?= $errors->html('cp') ?>

    <label for="typeMaison">Type de maison</label><br/>
    <select name="typeMaison" id="typeMaison">
        <?php
        foreach ($typesMaison as $typeMaison) {
            echo "<option value='" . $typeMaison['T_type'] . "'" . (($annonce['A_type_maison'] === $typeMaison['T_type']) ? "selected" : "") .">" . $typeMaison['T_description'] . "</option>";
        }
        ?>
    </select><br/>
    <?= $errors->html('typeMaison') ?>

    <label for="typeEnergie">Type d'énergie</label><br/>
    <select name="typeEnergie" id="typeEnergie">
        <?php
        foreach ($energies as $energie) {
            echo "<option value='" . $energie['E_id_engie'] . "' " . (($annonce['A_id_engie'] === $energie['E_id_engie']) ? "selected" : "") . ">" . $energie['E_description'] . "</option>";
        }
        ?>
    </select><br/>
    <?= $errors->html('typeEnergie') ?>

    <input class="button" type="submit" value="Modifier">

</form>

<script>
    const select_chauffage_changed = () => {
        const chauffageSelect = document.getElementById('chauffage');
        const energieSelect = document.getElementById('typeEnergie');
        if (chauffageSelect.value !== 'individuel') {
            energieSelect.setAttribute('disabled', 'true');
        } else {
            energieSelect.removeAttribute('disabled');
        }

    }
    select_chauffage_changed();
</script>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>
