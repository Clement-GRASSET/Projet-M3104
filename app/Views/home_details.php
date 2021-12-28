<?= view('templates/html_open.php') ?>

<?php var_dump($annonce); ?>

<p><a href="<?= base_url("/homes/" . $annonce['A_idannonce'] . "/contact") ?>">Contacter le propriétaire</a></p>

<?= view('templates/html_close.php') ?>
