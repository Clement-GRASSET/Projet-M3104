<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
echo view('templates/html_navbar');
$links = [
    ['url' => '/account/messages', 'name' => 'Messagerie'],
    ['url' => '/account/homes', 'name' => 'Mes annonces'],
    ['url' => '/account/settings', 'name' => 'Paramètres du compte'],
];
$type = 'Mon Compte';
echo view('templates/dashboard_open', ['links' => $links, 'type' => $type]);
?>

<h1>Discussion</h1>

<p>Nom de l'annonce : <?= $annonce['A_titre'] ?></p>
<p>Emétteur : <?= $emetteur['U_nom'] . " " . $emetteur['U_prenom'] ?></p>
<p>Destinataire : <?= $destinataire['U_nom'] . " " . $destinataire['U_prenom'] ?></p>
<br/>
<h2>Messages</h2>
<br/>
<?php

foreach ($messages as $message) {
    echo (($message['M_envoyeur'] === $emetteur['U_mail']) ? "Moi" : "Pas moi") . ", " . $message['M_dateheure_message'] . " :";
    echo "<p>" . $message['M_texte_message'] . "</p>";
    echo "<br/>";
}

?>

<form class="send-message-form" action="" method="post">

    <input type="text" name="message" placeholder="Message">
    <input type="submit" value="Envoyer">

</form>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>

