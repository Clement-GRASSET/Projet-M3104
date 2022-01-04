<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
echo view('templates/html_navbar');
echo view('templates/dashboard_open');
?>

<h1>Supprimer la photo</h1>

<p>Confirmer la suppression de la photo</p>
<p>Cette action est irréversible</p>
<form action="" method="post">
    <input class="button" type="submit" name="confirm" value="Confirmer">
</form>

<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>
