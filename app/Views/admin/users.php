<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
echo view('templates/html_navbar');
echo view('templates/dashboard_open');
?>

<h1>Utilisateurs</h1>

<?php

foreach ($users as $user) {
    echo "<a class='link' href='" . base_url("/admin/users/" . $user['U_mail']) . "'>" . $user['U_pseudo'] . " (" . $user['U_nom'] . " " . $user['U_prenom'] .  ")" . "</a>";
}

?>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>
