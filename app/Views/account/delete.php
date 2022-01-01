<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
$links = [
    ['url' => '/account/messages', 'name' => 'Messagerie'],
    ['url' => '/account/homes', 'name' => 'Mes annonces'],
    ['url' => '/account/settings', 'name' => 'Paramètres du compte'],
];
echo view('templates/dashboard_open', ['links' => $links]);
?>

<h1>Confirmez la suppression du compte</h1>

<form action="" method="post">

    <label for="email_confirm">Entrez votre adresse email pour confirmer la suppression du compte</label>
    <input type="text" name="email_confirm" id="email_confirm"><br/>

    <input class="button" type="submit" value="Supprimer mon compte">

</form>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>

