<?php

namespace App\Controllers;

use App\Models\AnnonceModel;
use App\Models\UtilisateurModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Account extends BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        if (!isset($this->session->user)) {
            $response->redirect("/login");
            $response->send();
            exit();
        }
    }

    public function messages()
    {
        $this->showView('account/messages');
    }

    public function homes()
    {
        $this->showView('account/homes');
    }

    public function add_home()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
                'titre' => [
                    'rules' => 'required'
                ],
                'loyer' => [
                    'rules' => 'required'
                ],
                'charges' => [
                    'rules' => 'required'
                ],
                'chauffage' => [
                    'rules' => 'required'
                ],
                'superficie' => [
                    'rules' => 'required'
                ],
                'description' => [
                    'rules' => 'required'
                ],
                'adresse' => [
                    'rules' => 'required'
                ],
                'ville' => [
                    'rules' => 'required'
                ],
                'cp' => [
                    'rules' => 'required'
                ],
                'etat' => [
                    'rules' => 'required'
                ],
            ])) {
            $annonce = [
                'A_titre' => 'Test Annonce',
                'A_cout_loyer' => '399.99',
                'A_cout_charges' => '19.99',
                'A_type_chauffage' => 'Li chaudière',
                'A_superficie' => '50',
                'A_description' => 'Li logement test',
                'A_adresse' => '2 rue du goulag',
                'A_ville' => 'Moskau',
                'A_CP' => '12345',
                'A_etat' => 'Mère patrie'
            ];
            $annonceModel = new AnnonceModel();
            $annonceModel->insert($annonce);
            return redirect()->to('/account/homes');
        } else {
            $data = [
                'errors' => (isset($this->validator)) ? $this->validator->getErrors() : [],
            ];
            $this->showView('account/add_home', $data);
        }
    }

    public function settings() {
        $utilisateurModel = new UtilisateurModel();
        $user = $utilisateurModel->find($this->session->user);
        $this->showView('account/settings', ["user"=>$user]);
    }

    public function delete() {
        $validation = $this->validate([
            "email_confirm" => [
                "rules" => "required"
            ]
        ]);
        if ($validation) {
            if ($this->session->user === $this->request->getPost("email_confirm")) {
                $utilisateurModel = new UtilisateurModel();
                $utilisateurModel->delete($this->session->user);
                return redirect()->to("/logout");
            } else {
                $this->showView('account/delete');
            }
        } else {
            $this->showView('account/delete');
        }
    }

    private function showView(string $name, array $data = [], array $options = [])
    {
        echo view("account/account", ["content"=>view($name, $data, $options)]);
    }
}