<?php

namespace App\Controllers;

use App\Classes\ValidationErrors;
use App\Models\AnnonceModel;
use App\Models\DiscussionModel;
use App\Models\PhotoModel;
use App\Models\UtilisateurModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Admin extends BaseController
{

    public function users()
    {
        $utilisateurModel = new UtilisateurModel();
        $utilisateurs = $utilisateurModel->findAll();
        $this->showView('admin/users.php', ['users' => $utilisateurs]);
    }

    public function user($mail)
    {
        $utilisateurModel = new UtilisateurModel();
        $utilisateur = $utilisateurModel->find($mail);
        if (empty($utilisateur)) {
            throw PageNotFoundException::forPageNotFound();
        }

        if ($this->request->getMethod() === 'post') {
            if (!empty($this->request->getPost('update'))) {
                $validation = $this->validate([
                    'pseudo' => [
                        'rules' => 'required|is_unique[T_utilisateur.U_pseudo]',
                        'errors' => [
                            'required' => 'Vous devez renseigner un pseudo',
                            'is_unique' => 'Ce pseudo est déjà utilisé'
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
                ]);
                if ($validation) {
                    $user = [
                        'U_pseudo' => $this->request->getPost('pseudo'),
                        'U_nom' => $this->request->getPost('nom'),
                        'U_prenom' => $this->request->getPost('prenom'),
                        'U_admin' => !empty($this->request->getPost('admin')) || $this->session->user === $mail,
                    ];
                    $utilisateurModel->update($mail, $user);
                    $this->sendMail($mail,"Modification des informations de votre compte par un Administrateur",view("mails/mail_type", [
                        'titre' =>"L'Administrateur a mis a jours les informations de votre compte",
                        'soustitre'=>"Connectez vous pour plus d'informations"]));
                }
            }
        }

        $this->showView('admin/user', ['user' => $utilisateur, 'me' => $mail===$this->session->user, 'errors' => new ValidationErrors((isset($this->validator))?$this->validator->getErrors():[]) ]);
    }

    public function user_mail($mail)
    {
        $utilisateurModel = new UtilisateurModel();
        $utilisateur = $utilisateurModel->find($mail);
        if (empty($utilisateur)) {
            throw PageNotFoundException::forPageNotFound();
        }

        if ($this->request->getPost('message_send') && $this->validate([
            'subject' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Vous devez renseigner un objet',
                ]
            ],
            'message' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Vous devez saisir un message',
                ]
            ]
        ])) {
            $this->sendMail($mail, $this->request->getPost('subject'), view('mails/mail_type', ['titre'=>$this->request->getPost('subject'),
                'soustitre'=>$this->request->getPost('message')]));
            return redirect()->to('/admin/users/'.$mail);
        }

        $this->showView('admin/contact_user', ['user' => $utilisateur, 'errors' => new ValidationErrors((isset($this->validator) ? $this->validator->getErrors() : []))]);
    }

    public function index(){
        return redirect()->to("/admin/users");
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
                $this->sendMail($mail,"Suppression de votre compte par un Administrateur",view("mails/mail_type", [
                                                    'titre' =>"L'Administrateur a supprimé votre compte",
                                                    'soustitre'=>"Nous sommes navré de vous l'appremdre, mais l'Administrateur a prit la décision de supprimer votre compte.
                                                    Cette décision est irrévocable. 
                                                    Cordialement, L'équipe Li Logement"]));
                return redirect()->to('/admin/users/');
            } else {
                return redirect()->to('/admin/users/'.$mail.'/delete');
            }
        }

        $this->showView('admin/delete_user', ['user'=>$utilisateur]);
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
                $this->sendMail($mail,"Blocage de vos annonces par un Administrateur",view("mails/mail_type", [
                    'titre' =>"L'Administrateur a bloqué toute les annonces de votre compte",
                    'soustitre'=>"Nous sommes navré de vous l'appremdre, mais l'Administrateur a prit la décision de bloquer les annonces de votre compte. 
                                                    Cordialement, L'équipe Li Logement"]));
                return redirect()->to('/admin/users/'.$mail);
            } else {
                return redirect()->to('/admin/users/'.$mail.'/block');
            }
        }

        $this->showView('admin/block_user', ['user'=>$utilisateur]);
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
                $this->sendMail($mail,"Déblocage de vos annonces par un Administrateur",view("mails/mail_type", [
                    'titre' =>"L'Administrateur a levé le blocage de vos annonces",
                    'soustitre'=>"Nous avons le plaisir de vous appremdre que l'Administrateur a prit la décision de lever le verrouillage de vos annonces.
                                                    Cordialement, L'équipe Li Logement"]));
                return redirect()->to('/admin/users/'.$mail);
            } else {
                return redirect()->to('/admin/users/'.$mail.'/unblock');
            }
        }

        $this->showView('admin/unblock_user', ['user'=>$utilisateur]);
    }

    public function homes()
    {
        $annonceModel = new AnnonceModel();
        $this->showView('admin/homes.php', [
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

        $this->showView('admin/home', ['annonce' => $annonceModel->addData($annonce), 'discussions'=>$discussions]);
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
                $this->sendMail($annonce['A_proprietaire'],"Blocage de votre annonce ".$annonce['A_titre']." par un Administrateur",view("mails/mail_type", [
                    'titre' =>"L'Administrateur a bloqué une de vos annonces",
                    'soustitre'=>"Nous sommes navré de vous l'appremdre, mais l'Administrateur a prit la décision de bloquer votre annonce nommé ".$annonce['A_titre'].".
                                                    Cordialement, L'équipe Li Logement"]));
                return redirect()->to('/admin/homes/'.$id);
            } else {
                return redirect()->to('/admin/homes/'.$id.'/block');
            }
        }

        $this->showView('admin/block_home', ['annonce' => $annonce]);
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
                $this->sendMail($annonce['A_proprietaire'],"Déblocage de votre annonce ".$annonce['A_titre']." par un Administrateur",view("mails/mail_type", [
                    'titre' =>"L'Administrateur a levé le blocage de votre annonce",
                    'soustitre'=>"Nous avons le plaisir de vous appremdre que l'Administrateur a prit la décision de lever le verrouillage de votre annonce ".$annonce['A_titre'].".
                                                    Cordialement, L'équipe Li Logement"]));
                return redirect()->to('/admin/homes/'.$id);
            } else {
                return redirect()->to('/admin/homes/'.$id.'/unblock');
            }
        }

        $this->showView('admin/unblock_home', ['annonce' => $annonce]);
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
                $this->sendMail($annonce['A_proprietaire'],"Suppression de votre annonce ".$annonce['A_titre']." par un Administrateur",view("mails/mail_type", [
                    'titre' =>"L'Administrateur a supprimé une de vos annonces",
                    'soustitre'=>"Nous sommes navré de vous l'appremdre, mais l'Administrateur a prit la décision de supprimer votre annonce nommé ".$annonce['A_titre'].".
                                                    Cette action est irrévocable.
                                                    Cordialement, L'équipe Li Logement"]));
                return redirect()->to('/admin/homes/');
            } else {
                return redirect()->to('/admin/homes/'.$id.'/delete');
            }
        }

        $this->showView('admin/delete_home', ['annonce' => $annonce]);
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
                $this->sendMail($mail,"Suppression des messages de votre annonce par un Administrateur",view("mails/mail_type", [
                    'titre' =>"L'Administrateur a supprimé les messafes d'une de vos annonces",
                    'soustitre'=>"Nous sommes navré de vous l'appremdre, mais l'Administrateur a prit la décision de supprimer les messages de votre annonce.
                                                    Cette action est irrévocable.
                                                    Cordialement, L'équipe Li Logement"]));
                return redirect()->to('/admin/homes/'.$id);
            } else {
                return redirect()->to('/admin/homes/'.$id.'/messages/'.$mail);
            }
        }

        $this->showView('admin/delete_discussion', []);
    }

    public function delete_photo($idannonce, $idphoto)
    {
        $photoModel = new PhotoModel();
        $photo = $photoModel->where(['P_idannonce'=>$idannonce, 'P_id_photo'=>$idphoto])->first();
        if (!isset($photo))
            throw PageNotFoundException::forPageNotFound();

        if ($this->request->getMethod() === 'post') {
            if (!empty($this->request->getPost('confirm'))) {
                unlink('./images/homes/'.$idannonce.'/'.$photo['P_nom']);
                $photoModel->delete($idphoto);

                return redirect()->to('/admin/homes/'.$idannonce);
            } else {
                return redirect()->to('/admin/homes/'.$idannonce.'/delete_photo/'.$idphoto);
            }
        }

        $this->showView('admin/delete_photo', []);
    }

    protected function showView(string $name, array $data = [], array $options = [])
    {
        $links = [
            ['url' => '/admin/users', 'name' => 'Utilisateurs'],
            ['url' => '/admin/homes', 'name' => 'Annonces'],
        ];
        $type = 'Administration';
        $data = array_merge($data, ['links'=>$links, 'type'=>$type]);
        parent::showView($name, $data, $options);
    }

}
