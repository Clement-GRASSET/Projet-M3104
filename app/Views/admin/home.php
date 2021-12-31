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
var_dump($home);
?>


<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>