<?php

namespace App\Controllers;

use App\Classes\ValidationErrors;
use App\Models\AnnonceModel;
use App\Models\DiscussionModel;
use App\Models\EnergieModel;
use App\Models\MessageModel;
use App\Models\PhotoModel;
use App\Models\TypeMaisonModel;
use App\Models\UtilisateurModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Account extends BaseController
{

    private $annonceValidation = [
        'titre' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Vous devez renseigner un titre'
            ]
        ],
        'loyer' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Vous devez renseigner un loyer'
            ]
        ],
        'charges' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Vous devez renseigner les charges'
            ]
        ],
        'chauffage' => [
            'rules' => 'required|typeChauffage',
            'errors' => [
                'required' => 'Vous devez renseigner un type de chauffage',
                'typeChauffage' => 'Le type de chauffage est invalide'
            ]
        ],
        'superficie' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Vous devez renseigner une superficie'
            ]
        ],
        'description' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Vous devez renseigner une description'
            ]
        ],
        'adresse' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Vous devez renseigner une adresse'
            ]
        ],
        'ville' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Vous devez renseigner une ville'
            ]
        ],
        'cp' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Vous devez renseigner un code postal'
            ]
        ],
        'typeMaison' => [
            'rules' => 'required|typeMaison',
            'errors' => [
                'required' => 'Vous devez renseigner un type de maison',
                'typeMaison' => 'Le type de maison est invalide'
            ]
        ],
        'typeEnergie' => [
            'rules' => 'requiredif[$_POST["chauffage"]==="individuel"]|typeEnergie',
            'errors' => [
                'requiredif' => 'Vous devez renseigner un type d\'énergie',
                'typeEnergie' => 'Le type d\'énergie est invalide'
            ]
        ],
    ];

    public function index()
    {
        return redirect()->to("/account/messages");
    }

    public function messages()
    {
        $discussionModel = new DiscussionModel();
        $annonceModel = new AnnonceModel();
        $utilisateurModel = new UtilisateurModel();

        $discussions = $discussionModel->where(['D_utilisateur'=>$this->session->user])->findAll();
        for ($i = 0; $i < sizeof($discussions); $i++) {
            $proprietaire = $utilisateurModel->find($annonceModel->find($discussions[$i]['D_idannonce'])['A_proprietaire']);
            $discussions[$i]['nom_destinataire'] = $proprietaire['U_nom'];
            $discussions[$i]['prenom_destinataire'] = $proprietaire['U_prenom'];
        }

        $annonces = $annonceModel->where(['A_proprietaire'=>$this->session->user])->findAll();
        foreach ($annonces as $annonce) {
            $discussion = $discussionModel->where(['D_idannonce'=>$annonce['A_idannonce']])->first();
            if (!empty($discussion)) {
                $destinataire = $utilisateurModel->find($discussion['D_utilisateur']);
                $discussion['nom_destinataire'] = $destinataire['U_nom'];
                $discussion['prenom_destinataire'] = $destinataire['U_prenom'];
                $discussions[] = $discussion;
            }
        }

        $data = array();
        foreach ($discussions as $discussion) {
            $annonce = $annonceModel->find($discussion['D_idannonce']);
            $data[] = [
                'nom' => $discussion['nom_destinataire'],
                'prenom' => $discussion['prenom_destinataire'],
                'annonce' => $annonce['A_titre'],
                'lien' => base_url('/account/messages/'.$discussion['D_iddiscussion']),
                'non_lu' => ($discussion['D_utilisateur'] === $this->session->user) ? $discussion['D_non_lu_utilisateur'] : $discussion['D_non_lu_proprietaire'],
            ];
        }
        $this->showView('account/messages', ['discussions' => $data]);
    }

    public function discussion($id)
    {
        $discussionModel = new DiscussionModel();
        $annonceModel = new AnnonceModel();
        $messageModel = new MessageModel();

        $discussion = $discussionModel->find($id);
        if (!isset($discussion))
            throw PageNotFoundException::forPageNotFound();

        $annonce = $annonceModel->find($discussion['D_idannonce']);

        // Test du droit d'acces aux messages
        $estProprietaire = false;
        if ($discussion['D_utilisateur'] === $this->session->user) {
            $estProprietaire = false;
        } else if ($annonce['A_proprietaire'] === $this->session->user) {
            $estProprietaire = true;
        } else {
            throw PageNotFoundException::forPageNotFound();
        }

        $discussionModel->update($id, ($estProprietaire) ? ['D_non_lu_proprietaire'=>false] : ['D_non_lu_utilisateur'=>false]);

        if ($this->request->getMethod() === 'post') {
            $valitation = $this->validate([
                'message' => [
                    'rules' => 'required',
                ]
            ]);
            if ($valitation) {
                $message = [
                    'M_envoyeur' => $this->session->user,
                    'M_texte_message' => $this->request->getPost('message'),
                ];
                $messageModel->newMessage($message, $discussion['D_idannonce'], $discussion['D_utilisateur']);
            }
            return redirect()->back();
        }

        $utilisateurModel = new UtilisateurModel();
        $emetteur = $utilisateurModel->find( ($estProprietaire) ? $annonce['A_proprietaire'] : $discussion['D_utilisateur'] );
        $destinataire = $utilisateurModel->find( ($estProprietaire) ? $discussion['D_utilisateur'] : $annonce['A_proprietaire'] );


        $messages = $messageModel->where(['M_iddiscussion'=>$discussion['D_iddiscussion']])->findAll();

        $this->showView('account/discussion', [
            'annonce' => $annonce,
            'emetteur' => $emetteur,
            'destinataire' => $destinataire,
            'messages' => $messages,
        ]);
    }

    public function homes()
    {
        $annonceModel = new AnnonceModel();
        $annonces = $annonceModel->where(['A_proprietaire'=>$this->session->user])->findAll();
        $this->showView('account/homes', ['annonces' => $annonces]);
    }

    public function add_home()
    {
        if ($this->request->getMethod() === 'post' && $this->validate($this->annonceValidation)) {
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
                'A_type_maison' => $this->request->getPost('typeMaison'),
                'A_id_engie' => ($this->request->getPost('chauffage') === 'individuel') ? $this->request->getPost('typeEnergie') : null,
            ];
            $annonceModel = new AnnonceModel();
            $annonceModel->insert($annonce);
            $annonce = $annonceModel->where($annonce)->first();

            return redirect()->to('/account/homes/' . $annonce['A_idannonce']);
        } else {
            $energieModel = new EnergieModel();
            $typeMaisonModel = new TypeMaisonModel();
            $energies = $energieModel->findAll();
            $typesMaison = $typeMaisonModel->findAll();
            $data = [
                'errors' => new ValidationErrors((isset($this->validator)) ?  $this->validator->getErrors() : []),
                'energies' => $energies,
                'typesMaison' => $typesMaison,
            ];
            $this->showView('account/add_home', $data);
        }
    }

    public function home($id)
    {
        $annonceModel = new AnnonceModel();
        $annonce = $annonceModel->where(['A_idannonce'=>$id, 'A_proprietaire'=>$this->session->user])->first();
        if (!isset($annonce))
            throw PageNotFoundException::forPageNotFound();

        if ($this->request->getPost('add_image') && $this->validate([
            'titre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Vous devez renseigner le titre de l\'image',
                ]
            ],
            'image' => [
                'rules' => 'uploaded[image]|is_image[image]',
                'errors' => [
                    'uploaded' => 'Vous devez sélectionner une image',
                    'is_image' => 'Le fichier choisi n\'est pas une image'
                ]
            ]
        ])) {
            $image = $this->request->getFile('image');
            if ($image->isValid() && !$image->hasMoved()) {
                $photoModel = new PhotoModel();
                if ($photoModel->where(['P_idannonce'=>$id])->countAllResults() >= 5) {
                    return redirect()->to('/account/homes/'.$id);
                }
                $photo = [
                    'P_titre' => $this->request->getPost('titre'),
                    'P_nom' => $image->getRandomName(),
                    'P_idannonce' => $id,
                ];
                $photoModel->insert($photo);
                $image->move('images/homes/'.$id.'/', $photo['P_nom']);
            }
            return redirect()->to('/account/homes/'.$id);
        }

        $this->showView('account/home', [
            'annonce' => $annonceModel->addData($annonce),
            'errors' => new ValidationErrors((isset($this->validator)) ? $this->validator->getErrors() : [])
        ]);
    }

    public function edit_home($id)
    {
        $annonceModel = new AnnonceModel();
        $annonce = $annonceModel->where(['A_idannonce'=>$id, 'A_proprietaire'=>$this->session->user])->first();
        if (!isset($annonce))
            throw PageNotFoundException::forPageNotFound();
        if ($annonce['A_etat'] !== 'en cours de rédaction' && $annonce['A_etat'] !== 'publiée' && $annonce['A_etat'] !== 'bloquée')
            throw PageNotFoundException::forPageNotFound();

        if ($this->request->getMethod() === 'post' && $this->validate($this->annonceValidation)) {
            $annonce_data = [
                'A_titre' => $this->request->getPost('titre'),
                'A_cout_loyer' => $this->request->getPost('loyer'),
                'A_cout_charges' => $this->request->getPost('charges'),
                'A_type_chauffage' => $this->request->getPost('chauffage'),
                'A_superficie' => $this->request->getPost('superficie'),
                'A_description' => $this->request->getPost('description'),
                'A_adresse' => $this->request->getPost('adresse'),
                'A_ville' => $this->request->getPost('ville'),
                'A_CP' => $this->request->getPost('cp'),
                'A_proprietaire' => $this->session->user,
                'A_type_maison' => $this->request->getPost('typeMaison'),
                'A_id_engie' => ($this->request->getPost('chauffage') === 'individuel') ? $this->request->getPost('typeEnergie') : null,
            ];
            $annonceModel->update($id, $annonce_data);
            $annonce = $annonceModel->where(['A_idannonce'=>$id, 'A_proprietaire'=>$this->session->user])->first();
        }
        $energieModel = new EnergieModel();
        $typeMaisonModel = new TypeMaisonModel();
        $energies = $energieModel->findAll();
        $typesMaison = $typeMaisonModel->findAll();
        $data = [
            'errors' => new ValidationErrors((isset($this->validator)) ?  $this->validator->getErrors() : []),
            'energies' => $energies,
            'typesMaison' => $typesMaison,
            'annonce' => $annonce,
        ];
        $this->showView('account/edit_home', $data);
    }

    public function delete_home($id)
    {
        $annonceModel = new AnnonceModel();
        $annonce = $annonceModel->where(['A_idannonce'=>$id, 'A_proprietaire'=>$this->session->user])->first();
        if (!isset($annonce))
            throw PageNotFoundException::forPageNotFound();
        if ($annonce['A_etat'] !== 'en cours de rédaction')
            throw PageNotFoundException::forPageNotFound();

        if ($this->request->getMethod() === 'post') {
            if (!empty($this->request->getPost('confirm'))) {
                $annonceModel->delete($id);
                return redirect()->to('/account/homes/');
            } else {
                return redirect()->to('/account/homes/'.$id.'/delete');
            }
        }

        $this->showView('account/delete_home', ['annonce'=>$annonce]);
    }

    public function publish_home($id)
    {
        $annonceModel = new AnnonceModel();
        $annonce = $annonceModel->where(['A_idannonce'=>$id, 'A_proprietaire'=>$this->session->user])->first();
        if (!isset($annonce))
            throw PageNotFoundException::forPageNotFound();
        if ($annonce['A_etat'] !== 'en cours de rédaction')
            throw PageNotFoundException::forPageNotFound();

        if ($this->request->getMethod() === 'post') {
            if (!empty($this->request->getPost('confirm'))) {
                $annonceModel->update($id, ['A_etat'=>'publiée']);
                return redirect()->to('/account/homes/'.$id);
            } else {
                return redirect()->to('/account/homes/'.$id.'/publish');
            }
        }

        $this->showView('account/publish_home', ['annonce'=>$annonce]);
    }

    public function archive_home($id)
    {
        $annonceModel = new AnnonceModel();
        $annonce = $annonceModel->where(['A_idannonce'=>$id, 'A_proprietaire'=>$this->session->user])->first();
        if (!isset($annonce))
            throw PageNotFoundException::forPageNotFound();
        if ($annonce['A_etat'] !== 'publiée')
            throw PageNotFoundException::forPageNotFound();

        if ($this->request->getMethod() === 'post') {
            if (!empty($this->request->getPost('confirm'))) {
                $annonceModel->update($id, ['A_etat'=>'archivée']);
                return redirect()->to('/account/homes/'.$id);
            } else {
                return redirect()->to('/account/homes/'.$id.'/archive');
            }
        }

        $this->showView('account/archive_home', ['annonce'=>$annonce]);
    }

    public function settings() {
        $utilisateurModel = new UtilisateurModel();
        $mail = $this->session->user;

        if ($this->request->getPost('update') && $this->validate([
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
        ])) {
            $utilisateurModel->update($mail, [
                'U_pseudo'=>$this->request->getPost('pseudo'),
                'U_nom'=>$this->request->getPost('nom'),
                'U_prenom'=>$this->request->getPost('prenom'),
            ]);
        }

        if ($this->request->getPost('update_password') && $this->validate([
                'password_new1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Vous devez renseigner un mot de passe'
                    ]
                ],
                'password_new2' => [
                    'rules' => 'required|matches[password_new1]',
                    'errors' => [
                        'required' => 'Vous devez confirmer le mot de passe',
                        'matches' => 'Le mot de passe ne correspond pas'
                    ]
                ],
            ])) {
            $utilisateurModel->update($mail, ['U_mdp'=>hash('sha256', $this->request->getPost('password_new2'))]);
        }

        $user = $utilisateurModel->find($this->session->user);
        $this->showView('account/settings', ["user" => $user, "errors" => new ValidationErrors( (isset($this->validator)) ? $this->validator->getErrors() : [] )]);
    }

    public function delete() {
        $utilisateurModel = new UtilisateurModel();
        $utilisateur = $utilisateurModel->find($this->session->user);
        if ($utilisateur['U_admin']) {
            throw PageNotFoundException::forPageNotFound();
        }

        $validation = $this->validate([
            "email_confirm" => [
                "rules" => "required"
            ]
        ]);
        if ($validation) {
            if ($this->session->user === $this->request->getPost("email_confirm")) {
                $utilisateurModel->delete($this->session->user);
                return redirect()->to("/logout");
            } else {
                $this->showView('account/delete');
            }
        } else {
            $this->showView('account/delete');
        }
    }

    public function delete_photo($idannonce, $idphoto)
    {
        $photoModel = new PhotoModel();
        $photo = $photoModel->where(['P_idannonce'=>$idannonce, 'P_id_photo'=>$idphoto])->first();
        if (!isset($photo))
            throw PageNotFoundException::forPageNotFound();

        $annonceModel = new AnnonceModel();
        $annonce = $annonceModel->where(['A_idannonce'=>$idannonce, 'A_proprietaire'=>$this->session->user])->first();
        if (!isset($annonce))
            throw PageNotFoundException::forPageNotFound();

        if ($this->request->getMethod() === 'post') {
            if (!empty($this->request->getPost('confirm'))) {
                unlink('./images/homes/'.$idannonce.'/'.$photo['P_nom']);
                $photoModel->delete($idphoto);
                return redirect()->to('/account/homes/'.$idannonce);
            } else {
                return redirect()->to('/account/homes/'.$idannonce.'/delete_photo/'.$idphoto);
            }
        }

        $this->showView('account/delete_photo', []);
    }

    protected function showView(string $name, array $data = [], array $options = [])
    {
        $links = [
            ['url' => '/account/messages', 'name' => 'Messagerie'],
            ['url' => '/account/homes', 'name' => 'Mes annonces'],
            ['url' => '/account/settings', 'name' => 'Paramètres du compte'],
        ];
        $type = 'Mon Compte';
        $data = array_merge($data, ['links'=>$links, 'type'=>$type]);
        parent::showView($name, $data, $options);
    }

}