<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
echo view('templates/html_navbar');
echo view('templates/dashboard_open');
?>

<h1>Messagerie</h1>

<?php

foreach ($discussions as $discussion) {
    echo "<a class='link' href='" . $discussion['lien'] . "'>" . $discussion['nom'] . " " . $discussion['prenom'] . ", " . $discussion['annonce'] . (($discussion['non_lu']) ? ' (Non lu)' : '') . "</a>";
}

?>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>
