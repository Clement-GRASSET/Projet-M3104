<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
$links = [
    ['url' => '/admin/users', 'name' => 'Utilisateurs'],
    ['url' => '/admin/homes', 'name' => 'Annonces'],
];
echo view('templates/dashboard_open', ['links' => $links]);
?>

<h1>Li maison</h1>

<?php
var_dump($annonce);
?>

<?php

switch ($annonce['A_etat']) {

    case 'publiée': {
        echo "<a class='button' href='" . base_url('/admin/homes/'.$annonce['A_idannonce'].'/block') . "'>Bloquer l'annonce</a>";
        break;
    }
    case 'bloquée': {
        echo "<a class='button' href='" . base_url('/admin/homes/'.$annonce['A_idannonce'].'/unblock') . "'>Débloquer l'annonce</a>";
        break;
    }
}
echo "<a class='button' href='" . base_url('/admin/homes/'.$annonce['A_idannonce'].'/delete') . "'>Supprimer l'annonce</a>";

?>


<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>