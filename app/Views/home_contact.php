<?= view('templates/html_open', ['styles'=>['homes.css'], 'fontAwesome'=>true]) ?>
<?= view('templates/html_navbar.php') ?>

<div class="content">

    <h1>Envoyer un message</h1>

    <form action="" method="post" class="contact-form">

        <textarea name="message"></textarea>
        <input type="submit" value="Envoyer">

    </form>

<?= view('templates/html_close.php') ?>

