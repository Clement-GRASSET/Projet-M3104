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
                "rules" => "required|valid_email"
            ],
            "password" => [
                "rules" => "required"
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
            var_dump($this->validator->getErrors());
            echo view('login.php');
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
        }
    }
}
