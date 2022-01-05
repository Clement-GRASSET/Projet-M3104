<?= view('templates/html_open', ['styles' => ['accueil.css','messagerie.css'], 'fontAwesome' => true]) ?>
<?= view('templates/html_navbar.php') ?>

<section class="home" id="home">

    <form action="" method="post" class="contact-form">
        <h3>Contacter <?= $annonce['A_proprietaire'] ?></h3>
        <br><br><br><br>
        <textarea id="textarea" name="message" placeholder="Entrez ici votre message à envoyer"></textarea>
        <button type="submit" class="btn btn-success">
            <i id="buttona" class="fas fa-paper-plane"></i> Envoyer
        </button>

    </form>


</section>
<?= view('templates/html_close.php') ?>

