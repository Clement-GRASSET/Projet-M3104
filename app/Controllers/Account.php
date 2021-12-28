<?php

namespace App\Controllers;

use App\Models\AnnonceModel;
use App\Models\DiscussionModel;
use App\Models\UtilisateurModel;
use CodeIgniter\Exceptions\PageNotFoundException;
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
        $discussionModel = new DiscussionModel();
        $annonceModel = new AnnonceModel();
        $discussions = $discussionModel->where(['D_utilisateur'=>$this->session->user])->findAll();

        $data = array();
        foreach ($discussions as $discussion) {
            $annonce = $annonceModel->find($discussion['D_idannonce']);
            $data[] = [
                'nom'=>'Nom',
                'prenom'=>'Prenom',
                'annonce'=>'Annonce',
                'lien'=>base_url('/account/messages/test')
            ];
        }
        $this->showView('account/messages', ['discussions' => $data]);
    }

    public function homes()
    {
        $annonceModel = new AnnonceModel();
        $annonces = $annonceModel->where(['A_proprietaire'=>$this->session->user])->findAll();
        $this->showView('account/homes', ['annonces' => $annonces]);
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
                'typeMaison' => [
                    'rules' => 'required'
                ],
            ])) {
            $annonce = [
                'A_titre' => $this->request->getPost('titre'),
                'A_cout_loyer' => $this->request->getPost('loyer'),
                'A_cout_charges' => $this->request->getPost('charges'),
                'A_type_chauffage' => $this->request->getPost('chauffage'),
                'A_superficie' => $this->request->getPost('superficie'),
                'A_description' => $this->request->getPost('description'),
                'A_adresse' => $this->request->getPost('adresse'),
                'A_ville' => $this->request->getPost('ville'),
                'A_CP' => $this->request->getPost('cp'),
                'A_etat' => 'en cours de rédaction',
                'A_proprietaire' => $this->session->user,
                'A_type_maison' => 'T1',
                'A_id_engie' => null,
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

    public function edit_home($id)
    {
        $annonceModel = new AnnonceModel();
        $annonce = $annonceModel->find($id);
        if (!isset($annonce))
            throw PageNotFoundException::forPageNotFound();
        $this->showView('account/edit_home', ['annonce'=>$annonce]);
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