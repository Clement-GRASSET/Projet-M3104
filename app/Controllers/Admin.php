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
        if ($this->request->getMethod() === 'post') {
            if (!empty($this->request->getPost('update'))) {
                $validation = $this->validate([
                    'pseudo' => [
                        'rules' => 'required',
                    ],
                    'nom' => [
                        'rules' => 'required',
                    ],
                    'prenom' => [
                        'rules' => 'required',
                    ],
                ]);
                if ($validation) {
                    $user = [
                        'U_pseudo' => $this->request->getPost('pseudo'),
                        'U_nom' => $this->request->getPost('nom'),
                        'U_prenom' => $this->request->getPost('prenom'),
                        'U_admin' => !empty($this->request->getPost('admin')) || $this->session->user === $mail,
                    ];
                    $utilisateurModel->update($mail, $user);
                }
            } else if (!empty($this->request->getPost('block'))) {
                die('block');
            } else if (!empty($this->request->getPost('unblock'))) {
                die('unblock');
            }
        }
        $utilisateur = $utilisateurModel->find($mail);
        if (empty($utilisateur)) {
            throw PageNotFoundException::forPageNotFound();
        }
        echo view('admin/user', ['user' => $utilisateur, 'me' => $mail===$this->session->user]);
    }

    public function user_mail($mail)
    {
        echo "Mail : " . $mail;
    }

    public function user_delete($mail)
    {
        if ($mail === $this->session->user) {
            throw PageNotFoundException::forPageNotFound();
        }
        echo "Delete : " . $mail;
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
        echo view('admin/home', ['home' => $annonce]);
    }

}
