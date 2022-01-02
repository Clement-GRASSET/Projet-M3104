<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
$links = [
    ['url' => '/account/messages', 'name' => 'Messagerie'],
    ['url' => '/account/homes', 'name' => 'Mes annonces'],
    ['url' => '/account/settings', 'name' => 'Paramètres du compte'],
];
echo view('templates/dashboard_open', ['links' => $links]);
?>

<h1>Ici c'est li messagerie</h1>

<?php

foreach ($discussions as $discussion) {
    echo "<a class='link' href='" . $discussion['lien'] . "'>" . $discussion['nom'] . " " . $discussion['prenom'] . ", " . $discussion['annonce'] . (($discussion['non_lu']) ? ' (Non lu)' : '') . "</a>";
}

?>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>
