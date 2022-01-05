<?php
echo view('templates/html_open', ['styles' => ['dashboard.css', 'messagerie.css']]);
echo view('templates/html_navbar');
echo view('templates/dashboard_open');
?>

<h1>Discussion</h1>
<h2>Chat avec
    <b><?= (($emetteur['U_mail'] === $loggedUser['U_mail']) ? $destinataire['U_pseudo'] : $emetteur['U_pseudo']) ?></b>
</h2>
<h2>Annonce : <?= $annonce['A_titre'] ?> (<?= sizeof($messages) ?> messages)</h2>

<ul id="chat">
    <?php

    foreach ($messages as $message) {

        echo '<li class="' . (($message['M_envoyeur'] === $emetteur['U_mail']) ? "me" : "you") . '">
        <div class="entete">
            <h2>' . (($message['M_envoyeur'] === $emetteur['U_mail']) ? $emetteur['U_pseudo'] : $destinataire['U_pseudo']) . '</h2>
            <h3>' . $message['M_dateheure_message'] . '</h3>
        </div>
        <div class="message">
            ' . $message['M_texte_message'] . '
        </div>
    </li>';
    }

    ?>
</ul>

<form id="send" action="" method="post">
    <input type="text" id="textarea" name="message" placeholder="Entrez votre message"></input>
    <button type="submit" class="btn btn-success">
        <i id="buttona" class="fas fa-paper-plane"></i>
    </button>
</form>
<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>

