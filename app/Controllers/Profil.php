<?php

namespace App\Controllers;

class Profil extends BaseController
{
    public function index()
    {
        echo view('templates/html_open.php');
        echo view('profil.php');
        echo view('templates/html_close.php');
    }
}
