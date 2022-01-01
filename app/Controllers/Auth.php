<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;

class Auth extends BaseController
{
    public function login()
    {
        echo view('login.php');
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
            $utilisateurModel = new UtilisateurModel();
            $result = $utilisateurModel->where([
                "U_mail" => $this->request->getPost("email"),
                "U_mdp" => hash("sha256", $this->request->getPost("password")),
            ])->findAll();
            var_dump($result);
            if (!empty($result)) {
                $this->session->user = $this->request->getPost("email");
                return redirect()->to("/");
            } else {
                echo view('login.php');
            }
        } else {
            echo view('login.php', ['errors'=>$this->validator->getErrors()]);
        }
    }

    public function register() {
        echo view('register.php');
    }

    public function register_post() {
        $validation = $this->validate([
            "email" => [
                "rules" => "required|valid_email"
            ],
            "pseudo" => [
                "rules" => "required"
            ],
            "nom" => [
                "rules" => "required"
            ],
            "prenom" => [
                "rules" => "required"
            ],
            "password" => [
                "rules" => "required"
            ],
            "password2" => [
                "rules" => "required|matches[password]"
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
            return redirect("/");
        } else {
            echo view('register.php', ['errors'=>$this->validator->getErrors()]);
        }
    }

    public function logout() {
        $this->session->remove('user');
        return redirect()->to("/");
    }
}
