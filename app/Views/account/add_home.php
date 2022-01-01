<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
$links = [
    ['url' => '/account/messages', 'name' => 'Messagerie'],
    ['url' => '/account/homes', 'name' => 'Mes annonces'],
    ['url' => '/account/settings', 'name' => 'Paramètres du compte'],
];
echo view('templates/dashboard_open', ['links' => $links]);
?>

<h1>Créer une annonce</h1>

<p>Errors :</p>
<?php var_dump($errors); ?>

<form action="" method="post">

    <label for="titre">Titre de l'annonce</label><br/>
    <input type="text" name="titre" id="titre"><br/>

    <label for="loyer">Loyer</label><br/>
    <input type="number" step="0.01" name="loyer" id="loyer"><br/>

    <label for="charges">Charges</label><br/>
    <input type="number" step="0.01" name="charges" id="charges"><br/>

    <label for="chauffage">Type de chauffage</label><br/>
    <select name="chauffage" id="chauffage">
        <option value="individuel">Individuel</option>
        <option value="collectif">Collectif</option>
    </select><br/>

    <label for="superficie">Superficie</label><br/>
    <input type="number" name="superficie" id="superficie"><br/>

    <label for="description">Description</label><br/>
    <textarea name="description" id="description"></textarea><br/>

    <label for="adresse">Adresse</label><br/>
    <input type="text" name="adresse" id="adresse"><br/>

    <label for="ville">Ville</label><br/>
    <input type="text" name="ville" id="ville"><br/>

    <label for="cp">Code postal</label><br/>
    <input type="text" name="cp" id="cp"><br/>

    <label for="typeMaison">Type de maison</label><br/>
    <select name="typeMaison" id="typeMaison">
        <?php
        foreach ($typesMaison as $typeMaison) {
            echo "<option value='" . $typeMaison['T_type'] . "'>" . $typeMaison['T_description'] . "</option>";
        }
        ?>
    </select><br/>

    <label for="typeEnergie">Type d'énergie</label><br/>
    <select name="typeEnergie" id="typeEnergie">
        <?php
        foreach ($energies as $energie) {
            echo "<option value='" . $energie['E_id_engie'] . "'>" . $energie['E_description'] . "</option>";
        }
        ?>
    </select><br/>

    <input class="button" type="submit" value="Créer">

</form>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>
