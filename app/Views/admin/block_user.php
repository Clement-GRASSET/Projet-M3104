<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
$links = [
    ['url' => '/admin/users', 'name' => 'Utilisateurs'],
    ['url' => '/admin/homes', 'name' => 'Annonces'],
];
echo view('templates/dashboard_open', ['links' => $links]);
?>

    <h1>Bloquer les annonces de <?= $user['U_pseudo'] ?></h1>

    <p>Confirmer le blocage des annonces</p>
    <form action="" method="post">
        <input class="button" type="submit" name="confirm" value="Confirmer">
    </form>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>