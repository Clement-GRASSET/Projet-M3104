<?= view('templates/html_open.php') ?>

<h1>Confirmez la suppression du compte</h1>

<p>Entrez votre adresse email pour confirmer la suppression du compte</p>

<form action="" method="post">

    <input type="text" name="email_confirm">

    <input type="submit" value="Supprimer mon compte">

</form>

<?= view('templates/html_close.php') ?>