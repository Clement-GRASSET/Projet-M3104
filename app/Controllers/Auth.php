<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use App\Controllers\Mailer;

class Auth extends BaseController
{
    public function login()
    {
        $this->showView('login.php', ['errors' => []]);
    }

    public function login_post() {
        $validation = $this->validate([
            "email" => [
                "rules" => "required|valid_email|login[email,password]",
                "errors" => [
                    "required" => "Vous devez renseigner une adresse email",
                    "valid_email" => "L'adresse email est incorrecte",
                    "login" => "Adresse email ou mot de passe incorrect"
                ]
            ],
            "password" => [
                "rules" => "required|login[email,password]",
                "errors" => [
                    "required" => "Vous devez renseigner un mot de passe",
                    "login" => "Adresse email ou mot de passe incorrect"
                ]
            ]
        ]);
        if ($validation) {
            $this->session->user = $this->request->getPost("email");
            return redirect()->to("/");
        } else {
            $this->showView('login.php', ['errors' => $this->validator->getErrors()]);
        }
    }

    public function register() {
        $this->showView('register.php', ['errors' => []]);
    }

    public function register_post() {
        $validation = $this->validate([
            "email" => [
                "rules" => "required|valid_email|is_unique[T_utilisateur.U_mail]",
                "errors" => [
                    "required" => "Vous devez rensigner votre adresse email",
                    "valid_email" => "Le format de l'adresse email n'est pas valide",
                    "is_unique" => "Cette adresse email est déja utilisée",
                ],
            ],
            "pseudo" => [
                "rules" => "required|is_unique[T_utilisateur.U_pseudo]",
                "errors" => [
                    "required" => "Vous devez renseigner un pseudo",
                    "is_unique" => "Ce pseudo email est déja utilisé",
                ],
            ],
            "nom" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Vous devez renseigner votre nom",
                ],
            ],
            "prenom" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Vous devez renseigner votre prénom",
                ],
            ],
            "password" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Vous devez renseigner un mot de passe",
                ],
            ],
            "password2" => [
                "rules" => "required|matches[password]",
                "errors" => [
                    "required" => "Vous devez confirmer votre mot de passe",
                ],
            ]
        ]);
        if ($validation) {
            $utilisateurModel = new UtilisateurModel();
            $utilisateur = [
                "U_mail" => $this->request->getPost("email"),
                "U_mdp" => hash("sha256", $this->request->getPost("password")),
                "U_pseudo" => $this->request->getPost("pseudo"),
                "U_nom" => $this->request->getPost("nom"),
                "U_prenom" => $this->request->getPost("prenom"),
                "U_admin" => "false"
            ];
            $utilisateurModel->insert($utilisateur);
            $this->session->user = $utilisateur["U_mail"];
            $this->sendMail($utilisateur['U_mail'],"Bienvenue sur Li Logement", view("mails/mail_welcome", ['pseudo' =>$utilisateur['U_pseudo']]));
            return redirect("/");
        } else {
            $this->showView('register.php', ['errors' => $this->validator->getErrors()]);
        }
    }

    public function logout() {
        $this->session->remove('user');
        return redirect()->to("/");
    }
}
