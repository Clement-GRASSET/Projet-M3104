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

<p>Entrez votre adresse email pour confirmer la suppression du compte</p>

<form action="" method="post">

    <input type="text" name="email_confirm">

    <input type="submit" value="Supprimer mon compte">

</form>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>

