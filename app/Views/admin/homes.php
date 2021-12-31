<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
$links = [
    ['url' => '/admin/users', 'name' => 'Utilisateurs'],
    ['url' => '/admin/homes', 'name' => 'Annonces'],
];
echo view('templates/dashboard_open', ['links' => $links]);
?>

<h1>Li maisons</h1>

<?php

foreach ($homes as $home) {
    echo "<a class='link' href='" . base_url("/admin/homes/" . $home['A_idannonce']) . "'>" . $home['A_titre'] . "</a>";
}

?>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>
