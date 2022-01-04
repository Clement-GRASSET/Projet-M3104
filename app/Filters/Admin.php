<?php

namespace App\Filters;

use App\Models\UtilisateurModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Admin implements FilterInterface {

    public function before(RequestInterface $request, $arguments = null)
    {
        $session = \Config\Services::session();
        $utilisateurModel = new UtilisateurModel();
        $utilisateur = $utilisateurModel->find($session->user);

        if (!$utilisateur['U_admin'])
            throw PageNotFoundException::forPageNotFound();
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}