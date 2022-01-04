<?= view('templates/html_open', ['styles'=>['homes.css'], 'fontAwesome'=>true]) ?>
<?= view('templates/html_navbar.php') ?>

<div class="content">

    <h1><?= $annonce['A_titre'] ?> - Photos</h1>

    <img src='<?= base_url('/images/homes/'.$annonce['A_idannonce'].'/'.$photo['P_nom']) ?>'>

    <?= view('templates/html_close.php') ?>
