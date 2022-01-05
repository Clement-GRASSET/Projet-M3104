<?= view('templates/html_open', ['styles'=>['config.css']]) ?>

<div class="Absolute-Center">

    <div class="content">
        <h1>Créez votre compte administrateur</h1>

        <form action="" method="post">

            <label for="mail">Adresse email</label><br/>
            <input type="email" id="mail" name="mail"><br/>
            <?= $errors->html('mail') ?>

            <label for="nom">Pseudo</label><br/>
            <input type="text" id="pseudo" name="pseudo"><br/>
            <?= $errors->html('pseudo') ?>

            <label for="pseudo">Nom</label><br/>
            <input type="text" id="nom" name="nom"><br/>
            <?= $errors->html('nom') ?>

            <label for="prenom">Prénom</label><br/>
            <input type="text" id="prenom" name="prenom"><br/>
            <?= $errors->html('prenom') ?>

            <label for="password1">Mot de passe</label><br/>
            <input type="password" id="password1" name="password1"><br/>
            <?= $errors->html('password1') ?>

            <label for="password2">Confirmation du mot de passe</label><br/>
            <input type="password" id="password2" name="password2"><br/>
            <?= $errors->html('password2') ?>

            <input type="submit" name="register" value="Créer mon compte">

        </form>
    </div>

</div>



<?= view('templates/html_close') ?>