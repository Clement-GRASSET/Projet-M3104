<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
echo view('templates/html_navbar');
echo view('templates/dashboard_open');
?>

<h1>Créer une annonce</h1>

<form action="" method="post">

    <label for="titre">Titre de l'annonce</label><br/>
    <input type="text" name="titre" id="titre"><br/>
    <?= $errors->html('titre') ?>

    <label for="loyer">Loyer</label><br/>
    <input type="number" step="0.01" name="loyer" id="loyer"><br/>
    <?= $errors->html('loyer') ?>

    <label for="charges">Charges</label><br/>
    <input type="number" step="0.01" name="charges" id="charges"><br/>
    <?= $errors->html('charges') ?>

    <label for="chauffage">Type de chauffage</label><br/>
    <select name="chauffage" id="chauffage" onchange="select_chauffage_changed()">
        <option value="individuel">Individuel</option>
        <option value="collectif">Collectif</option>
    </select><br/>
    <?= $errors->html('chauffage') ?>

    <label for="superficie">Superficie</label><br/>
    <input type="number" name="superficie" id="superficie"><br/>
    <?= $errors->html('superficie') ?>

    <label for="description">Description</label><br/>
    <textarea name="description" id="description"></textarea><br/>
    <?= $errors->html('description') ?>

    <label for="adresse">Adresse</label><br/>
    <input type="text" name="adresse" id="adresse"><br/>
    <?= $errors->html('adresse') ?>

    <label for="ville">Ville</label><br/>
    <input type="text" name="ville" id="ville"><br/>
    <?= $errors->html('ville') ?>

    <label for="cp">Code postal</label><br/>
    <input type="text" name="cp" id="cp"><br/>
    <?= $errors->html('cp') ?>

    <label for="typeMaison">Type de maison</label><br/>
    <select name="typeMaison" id="typeMaison">
        <?php
        foreach ($typesMaison as $typeMaison) {
            echo "<option value='" . $typeMaison['T_type'] . "'>" . $typeMaison['T_description'] . "</option>";
        }
        ?>
    </select><br/>
    <?= $errors->html('typeMaison') ?>

    <label for="typeEnergie">Type d'énergie</label><br/>
    <select name="typeEnergie" id="typeEnergie">
        <?php
        foreach ($energies as $energie) {
            echo "<option value='" . $energie['E_id_engie'] . "'>" . $energie['E_description'] . "</option>";
        }
        ?>
    </select><br/>
    <?= $errors->html('typeEnergie') ?>
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
