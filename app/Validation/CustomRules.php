<?php

namespace App\Validation;

use App\Models\EnergieModel;
use App\Models\TypeMaisonModel;
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

    public function typeMaison(?string $str) : bool
    {
        if (!isset($str)) return true;

        $typeMaisonModel = new TypeMaisonModel();
        $typeMaison = $typeMaisonModel->find($str);
        return !empty($typeMaison);
    }

    public function typeChauffage(?string $str) : bool
    {
        if (!isset($str)) return true;

        return $str === 'individuel' || $str === 'collectif';
    }

    public function typeEnergie(?string $str) : bool
    {
        if (!isset($str)) return true;

        $energieModel = new EnergieModel();
        $energie = $energieModel->find($str);
        return !empty($energie);
    }

    public function requiredif(?string $str, string $fields, array $data) : bool
    {
        $test = eval("return " . $fields . ";");
        $required = isset($str) || !$test;
        return $required;
    }

}