<?= view('templates/html_open', ['styles'=>[''], 'fontAwesome'=>true]) ?>
<?= view('templates/html_navbar.php') ?>


<br/><br/><br/><br/><br/><br/><br/>

<div>

    <?php var_dump($annonce); ?>

    <br/><br/>
    <p><a href="<?= base_url("/homes/" . $annonce['A_idannonce'] . "/contact") ?>">Contacter le propriétaire</a></p>

</div>



<?= view('templates/html_close.php') ?>
