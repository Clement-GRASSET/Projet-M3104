<?= view('templates/html_open', ['styles'=>['config.css']]) ?>

<div class="Absolute-Center">

    <div class="content">
        <h1>Bienvenue sur<br/>Li Logement</h1>

        <?php if ($empty) { ?>
            <p>La base de données est prête à être créée</p>
            <br/>
            <a href="<?= base_url('/config/register') ?>">Créer mon compte</a>
        <?php } else { ?>
            <p>La base de données contient déjà des tables :</p>
            <br/>
            <?php
            foreach ($tables as $table) {
                echo "<p>" . $table ."</p>";
            }
            ?>
            <br/>
            <p>Videz la ou utilisez une autre base de données pour configurer le site</p>
        <?php } ?>
    </div>

</div>

<?= view('templates/html_close') ?>
