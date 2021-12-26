<?php

namespace App\Controllers;

use App\Models\AnnonceModel;

class Home extends BaseController
{
    public function index()
    {
        echo view('index.php');
    }

    public function homes()
    {
        $annonceModel = new AnnonceModel();
        $annonces = $annonceModel->findAll();
        echo view('homes.php', ['annonces'=>$annonces]);
    }
}
