<h1>Discussion</h1>
<br/>
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

<form action="" method="post">

    <input type="text" name="message" placeholder="Message">
    <input type="submit" value="Envoyer">

</form>
