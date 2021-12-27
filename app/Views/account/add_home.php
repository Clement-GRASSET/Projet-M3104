<h1>Créer une annonce</h1>

<p>Errors :</p>
<?php var_dump($errors); ?>

<form action="" method="post">

    <input type="text" name="titre" placeholder="Titre">
    <input type="number" name="loyer" placeholder="Loyer">
    <input type="number" name="charges" placeholder="Charges">
    <label>
        Type de chauffage
        <select name="chauffage">
            <option value="individuel">Individuel</option>
            <option value="collectif">Collectif</option>
        </select>
    </label>
    <input type="number" name="superficie" placeholder="Superficie">
    <textarea name="description" placeholder="description"></textarea>
    <input type="text" name="adresse" placeholder="Adresse">
    <input type="text" name="ville" placeholder="Ville">
    <input type="text" name="cp" placeholder="Code postal">
    <label>
        Type de maison
        <select name="typeMaison">
            <option value="T1">T1</option>
            <option value="T2">T2</option>
            <option value="T3">T3</option>
            <option value="T4">T4</option>
            <option value="T5">T5</option>
            <option value="T6">T6</option>
        </select>
    </label>

    <input type="submit" value="Créer">

</form>
