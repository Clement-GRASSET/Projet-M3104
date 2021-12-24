<?= view('templates/html_open.php') ?>

<div class="Absolute-Center">

    <div class="auth">

        <form action="" method="post">

            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email">

            <label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo">

            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom">

            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom">

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password">

            <label for="password2">Confirmer le mot de passe</label>
            <input type="password" id="password2" name="password2">

            <input type="submit" name="submit" value="Créer un compte"/>

            <p><a href="<?= base_url("/login") ?>">Cliquez ici pour vous connecter</a></p>

        </form>

    </div>

</div>

<?= view('templates/html_close.php') ?>
