<?php

namespace App\Controllers;

use App\Models\AnnonceModel;
use App\Models\DiscussionModel;
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
        if ($mail === $this->session->user)
            throw PageNotFoundException::forPageNotFound();

        $utilisateurModel = new UtilisateurModel();
        $utilisateur = $utilisateurModel->find($mail);
        if (!isset($utilisateur))
            throw PageNotFoundException::forPageNotFound();

        if ($this->request->getMethod() === 'post') {
            if (!empty($this->request->getPost('confirm'))) {
                $utilisateurModel->delete($mail);
                return redirect()->to('/admin/users/');
            } else {
                return redirect()->to('/admin/users/'.$mail.'/delete');
            }
        }

        echo view('admin/delete_user', ['user'=>$utilisateur]);
    }

    public function user_block($mail)
    {
        $utilisateurModel = new UtilisateurModel();
        $utilisateur = $utilisateurModel->find($mail);
        if (!isset($utilisateur))
            throw PageNotFoundException::forPageNotFound();

        if ($this->request->getMethod() === 'post') {
            if (!empty($this->request->getPost('confirm'))) {
                $annonceModel = new AnnonceModel();
                $annonces = $annonceModel->where(['A_proprietaire'=>$mail, 'A_etat'=>'publiée'])->findAll();
                foreach ($annonces as $annonce) {
                    $annonceModel->update($annonce['A_idannonce'], ['A_etat'=>'bloquée']);
                }
                return redirect()->to('/admin/users/'.$mail);
            } else {
                return redirect()->to('/admin/users/'.$mail.'/block');
            }
        }

        echo view('admin/block_user', ['user'=>$utilisateur]);
    }

    public function user_unblock($mail)
    {
        $utilisateurModel = new UtilisateurModel();
        $utilisateur = $utilisateurModel->find($mail);
        if (!isset($utilisateur))
            throw PageNotFoundException::forPageNotFound();

        if ($this->request->getMethod() === 'post') {
            if (!empty($this->request->getPost('confirm'))) {
                $annonceModel = new AnnonceModel();
                $annonces = $annonceModel->where(['A_proprietaire'=>$mail, 'A_etat'=>'bloquée'])->findAll();
                foreach ($annonces as $annonce) {
                    $annonceModel->update($annonce['A_idannonce'], ['A_etat'=>'publiée']);
                }
                return redirect()->to('/admin/users/'.$mail);
            } else {
                return redirect()->to('/admin/users/'.$mail.'/unblock');
            }
        }

        echo view('admin/unblock_user', ['user'=>$utilisateur]);
    }

    public function homes()
    {
        $annonceModel = new AnnonceModel();
        echo view('admin/homes.php', [
            'annonces_publiées' => $annonceModel->where(['A_etat'=>'publiée'])->findAll(),
            'annonces_bloquées' => $annonceModel->where(['A_etat'=>'bloquée'])->findAll(),
            'annonces_archivées' => $annonceModel->where(['A_etat'=>'archivée'])->findAll()
        ]);
    }

    public function home($id)
    {
        $annonceModel = new AnnonceModel();
        $annonce = $annonceModel->find($id);
        $discussionModel = new DiscussionModel();
        $discussions = $discussionModel->where(['D_idannonce'=>$id])->findAll();
        if (empty($annonce))
            throw PageNotFoundException::forPageNotFound();
        if ($annonce['A_etat'] !== 'publiée' && $annonce['A_etat'] !== 'archivée' && $annonce['A_etat'] !== 'bloquée')
            throw PageNotFoundException::forPageNotFound();

        echo view('admin/home', ['annonce' => $annonce, 'discussions'=>$discussions]);
    }

    public function block_home($id)
    {
        $annonceModel = new AnnonceModel();
        $annonce = $annonceModel->find($id);
        if (empty($annonce))
            throw PageNotFoundException::forPageNotFound();
        if ($annonce['A_etat'] !== 'publiée')
            throw PageNotFoundException::forPageNotFound();

        if ($this->request->getMethod() === 'post') {
            if (!empty($this->request->getPost('confirm'))) {
                $annonceModel->update($id, ['A_etat'=>'bloquée']);
                return redirect()->to('/admin/homes/'.$id);
            } else {
                return redirect()->to('/admin/homes/'.$id.'/block');
            }
        }

        echo view('admin/block_home', ['annonce' => $annonce]);
    }

    public function unblock_home($id)
    {
        $annonceModel = new AnnonceModel();
        $annonce = $annonceModel->find($id);
        if (empty($annonce))
            throw PageNotFoundException::forPageNotFound();
        if ($annonce['A_etat'] !== 'bloquée')
            throw PageNotFoundException::forPageNotFound();

        if ($this->request->getMethod() === 'post') {
            if (!empty($this->request->getPost('confirm'))) {
                $annonceModel->update($id, ['A_etat'=>'publiée']);
                return redirect()->to('/admin/homes/'.$id);
            } else {
                return redirect()->to('/admin/homes/'.$id.'/unblock');
            }
        }

        echo view('admin/unblock_home', ['annonce' => $annonce]);
    }

    public function delete_home($id)
    {
        $annonceModel = new AnnonceModel();
        $annonce = $annonceModel->find($id);
        if (empty($annonce))
            throw PageNotFoundException::forPageNotFound();
        if ($annonce['A_etat'] !== 'publiée' && $annonce['A_etat'] !== 'archivée' && $annonce['A_etat'] !== 'bloquée')
            throw PageNotFoundException::forPageNotFound();

        if ($this->request->getMethod() === 'post') {
            if (!empty($this->request->getPost('confirm'))) {
                $annonceModel->delete($id);
                return redirect()->to('/admin/homes/');
            } else {
                return redirect()->to('/admin/homes/'.$id.'/delete');
            }
        }

        echo view('admin/delete_home', ['annonce' => $annonce]);
    }

    public function delete_discussion($id, $mail)
    {
        $discussionModel = new DiscussionModel();
        $discussion = $discussionModel->where(['D_idannonce'=>$id, 'D_utilisateur'=>$mail])->first();
        if (!isset($discussion))
            throw PageNotFoundException::forPageNotFound();

        if ($this->request->getMethod() === 'post') {
            if (!empty($this->request->getPost('confirm'))) {
                $discussionModel->delete(['D_idannonce'=>$id, 'D_utilisateur'=>$mail]);
                return redirect()->to('/admin/homes/'.$id);
            } else {
                return redirect()->to('/admin/homes/'.$id.'/messages/'.$mail);
            }
        }

        echo view('admin/delete_discussion', []);
    }

}
