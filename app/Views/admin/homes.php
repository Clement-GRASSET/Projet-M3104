<?= view('templates/html_open.php') ?>

<h1>Li maisons</h1>

<?php

foreach ($homes as $home) {
    echo "<p><a href='" . base_url("/admin/homes/" . $home['A_idannonce']) . "'>" . $home['A_titre'] . "</a></p>";
}

?>

<?= view('templates/html_close.php') ?>
