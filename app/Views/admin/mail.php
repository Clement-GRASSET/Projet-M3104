<?php
echo view('templates/html_open', ['styles'=>['dashboard.css']]);
echo view('templates/html_navbar');
echo view('templates/dashboard_open');
?>


<?php
echo view('templates/dashboard_close');
echo view('templates/html_close');
?>
