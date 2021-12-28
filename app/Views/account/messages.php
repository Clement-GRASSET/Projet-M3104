<h1>Ici c'est li messagerie</h1>

<?php

foreach ($discussions as $discussion) {
    echo "<p><a href='" . $discussion['lien'] . "'>" . $discussion['nom'] . " " . $discussion['prenom'] . ", " . $discussion['annonce'] . "</a></p>";
}

?>
