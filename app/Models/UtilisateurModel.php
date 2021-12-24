<?php

namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model
{
    protected $table = 'T_utilisateur';
    protected $primaryKey = 'U_mail';
    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'U_mail',
        'U_mdp',
        'U_pseudo',
        'U_nom',
        'U_prenom',
        'U_admin'
    ];
}