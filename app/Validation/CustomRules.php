<?php

namespace App\Validation;

use App\Models\UtilisateurModel;

class CustomRules {

    public function login(string $str, string $fields, array $data) : bool
    {
        $email = $data['email'];
        $password = hash('sha256', $data['password']);
        $utilisateurModel = new UtilisateurModel();
        $utilisateur = $utilisateurModel->where(['U_mail' => $email, 'U_mdp' => $password])->first();
        return !empty($utilisateur);
    }

}