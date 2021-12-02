<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        echo view('templates/header.php');
        echo view('login.php');
        echo view('templates/footer.php');
    }

    public function register() {
        echo view('templates/header.php');
        echo view('register.php');
        echo view('templates/footer.php');
    }
}
