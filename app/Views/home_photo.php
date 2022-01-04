<?= view('templates/html_open', ['styles'=>['homes.css'], 'fontAwesome'=>true]) ?>
<?= view('templates/html_navbar.php') ?>

<div class="content">

    <h1><?= $annonce['A_titre'] ?> - Photos</h1>

    <h2><?= $photo['P_titre'] ?></h2>

    <div class="photos">
        <img src='<?= base_url('/images/homes/'.$annonce['A_idannonce'].'/'.$photo['P_nom']) ?>'>
        <div class="selector">
            <?php foreach ($photos as $p) { ?>
            <a href="<?= base_url('/homes/'.$annonce['A_idannonce'].'/photo?id='.$p['P_id_photo']) ?>">
                <img alt="Photo" src="<?= base_url('/images/homes/'.$annonce['A_idannonce'].'/'.$p['P_nom']) ?>">
            </a>
            <?php } ?>
        </div>
    </div>

    <?= view('templates/html_close.php') ?>
