<?php

namespace App\Filters;

use App\Models\UtilisateurModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Login implements FilterInterface {

    public function before(RequestInterface $request, $arguments = null)
    {
        $session = \Config\Services::session();

        if (!isset($session->user))
            return redirect()->to('/login');

        $utilisateurModel = new UtilisateurModel();
        $utilisateur = $utilisateurModel->find($session->user);

        if (!isset($utilisateur)) {
            $session->remove('user');
            return redirect()->to('/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}