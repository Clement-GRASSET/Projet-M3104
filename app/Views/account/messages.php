<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
echo view('templates/html_navbar');
echo view('templates/dashboard_open');
?>

<h1>Messagerie</h1>

<?php

foreach ($discussions as $annonces) {

    echo "<h2>" . $annonces['annonce']['A_titre'] . "</h2>";

    foreach ($annonces['discussions'] as $discussion) {
        echo "<a class='link" . (($discussion['non_lu']) ? ' new-message' : '') . "' href='" . $discussion['lien'] . "'>" . $discussion['nom'] . " " . $discussion['prenom'] . "</a>";
    }

}

?>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>
