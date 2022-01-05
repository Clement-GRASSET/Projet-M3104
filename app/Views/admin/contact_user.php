<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
echo view('templates/html_navbar');
echo view('templates/dashboard_open');
?>

    <h1>Contacter <?= $user['U_pseudo'] ?></h1>

    <form action="" method="post">
        <label for="subject">Objet</label><br/>
        <input type="text" name="subject" id="subject"><br/>
        <?= $errors->html('subject') ?>
        <label for="message">Message</label><br/>
        <textarea id="message" name="message"></textarea><br/>
        <?= $errors->html('message') ?>
        <input class="button" type="submit" name="message_send" value="Envoyer">
    </form>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>