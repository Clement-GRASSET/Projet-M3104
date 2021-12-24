<?= view('templates/html_open.php') ?>

<div class="Absolute-Center">

    <div class="auth">

        <form action="" method="post">

            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email">

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password">

            <input type="submit" name="submit"/>

            <p><a href="<?= base_url("/register") ?>">Cliquez ici pour vous inscrire</a></p>

        </form>

    </div>

</div>

<?= view('templates/html_close.php') ?>
