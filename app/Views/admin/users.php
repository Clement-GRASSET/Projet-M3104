<?= view('templates/html_open.php') ?>

<h1>Li utilisateurs</h1>

<?php

foreach ($users as $user) {
    echo "<p><a href='" . base_url("/admin/users/" . $user['U_mail']) . "'>" . $user['U_pseudo'] . " (" . $user['U_nom'] . " " . $user['U_prenom'] .  ")" . "</a></p>";
}

?>

<?= view('templates/html_close.php') ?>
