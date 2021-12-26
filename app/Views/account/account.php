<?= view('templates/html_open.php') ?>

<div>

    <div>
        <p><a href="<?= base_url("/account/messages") ?>">Messagerie</a></p>
        <p><a href="<?= base_url("/account/homes") ?>">Mes annonces</a></p>
        <p><a href="<?= base_url("/account/settings") ?>">Paramètres</a></p>
    </div>

    <div>
        <?= $content ?>
    </div>

</div>

<?= view('templates/html_close.php') ?>
