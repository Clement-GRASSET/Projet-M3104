<?php

namespace App\Controllers;

class Profil extends BaseController
{
    public function index()
    {
        echo view('templates/header.php');
        echo view('profil.php');
        echo view('templates/footer.php');
    }
}
