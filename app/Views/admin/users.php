<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
$links = [
    ['url' => '/admin/users', 'name' => 'Utilisateurs'],
    ['url' => '/admin/homes', 'name' => 'Annonces'],
];
$type = 'Admin Panel';
echo view('templates/dashboard_open', ['links' => $links, 'type' => $type]);
?>

<h1>Li utilisateurs</h1>

<?php

foreach ($users as $user) {
    echo "<a class='link' href='" . base_url("/admin/users/" . $user['U_mail']) . "'>" . $user['U_pseudo'] . " (" . $user['U_nom'] . " " . $user['U_prenom'] .  ")" . "</a>";
}

?>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>
