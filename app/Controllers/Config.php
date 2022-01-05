<?php

namespace App\Controllers;

use App\Classes\DatabaseUtils;
use App\Classes\ValidationErrors;
use App\Models\UtilisateurModel;
use CodeIgniter\Controller;

class Config extends Controller
{
    public function index()
    {
        $databaseUtils = new DatabaseUtils();
        $tables = $databaseUtils->getTables();

        echo view('config/index', ['empty'=>$databaseUtils->isEmpty(), 'tables'=>$tables]);
    }

    public function register()
    {
        if ($this->request->getPost('register') && $this->validate([
            'mail' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Vous devez renseigner un mail',
                    'valid_email' => 'Format d\'adresse email incorrect'
                ]
            ],
            'pseudo' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Vous devez renseigner un pseudo'
                ]
            ],
            'nom' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Vous devez renseigner un nom'
                ]
            ],
            'prenom' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Vous devez renseigner un prénom'
                ]
            ],
            'password1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Vous devez renseigner un mot de passe'
                ]
            ],
            'password2' => [
                'rules' => 'required|matches[password1]',
                'errors' => [
                    'required' => 'Vous devez confirmer le mot de passe',
                    'matches' => 'Les mots de passes ne correspondent pas'
                ]
            ],
        ])) {
            $databaseUtils = new DatabaseUtils();
            $databaseUtils->createTables();
            $utilisateurModel = new UtilisateurModel();
            $utilisateur = [
                'U_mail' => $this->request->getPost('mail'),
                'U_pseudo' => $this->request->getPost('pseudo'),
                'U_nom' => $this->request->getPost('nom'),
                'U_prenom' => $this->request->getPost('prenom'),
                'U_mdp' => hash('sha256', $this->request->getPost('password1')),
                'U_admin' => true,
            ];
            $utilisateurModel->insert($utilisateur);
            $session = \Config\Services::session();
            $session->user = $utilisateur['U_mail'];
            return redirect()->to('/');
        }

        echo view('config/register', ['errors' => new ValidationErrors(($this->validator) ? $this->validator->getErrors() : [])]);
    }
}
