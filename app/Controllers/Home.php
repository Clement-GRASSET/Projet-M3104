<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view('templates/header.php');
        echo view('home.php');
        echo view('templates/footer.php');
    }

    public function login()
    {
        echo view('login.php');
    }

    public function register() {
        echo "UUUUUUUU";
    }
}
