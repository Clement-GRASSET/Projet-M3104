<?php

namespace App\Controllers;

use App\Models\AnnonceModel;
use App\Models\UtilisateurModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Admin extends Account
{

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $utilisateurModel = new UtilisateurModel();
        $utilisateur = $utilisateurModel->find($this->session->user);
        if (!$utilisateur['U_admin']) {
            throw PageNotFoundException::forPageNotFound();
        }
    }

    public function users()
    {
        $utilisateurModel = new UtilisateurModel();
        $utilisateurs = $utilisateurModel->findAll();
        echo view('admin/users.php', ['users' => $utilisateurs]);
    }

    public function user($mail)
    {
        $utilisateurModel = new UtilisateurModel();
        $utilisateur = $utilisateurModel->find($mail);
        if (empty($utilisateur)) {
            throw PageNotFoundException::forPageNotFound();
        }
        var_dump($utilisateur);
    }

    public function homes()
    {
        $annonceModel = new AnnonceModel();
        $annonces = $annonceModel->findAll();
        echo view('admin/homes.php', ['homes' => $annonces]);
    }

    public function home($id)
    {
        $annonceModel = new AnnonceModel();
        $annonce = $annonceModel->find($id);
        if (empty($annonce)) {
            throw PageNotFoundException::forPageNotFound();
        }
        var_dump($annonce);
    }

}
