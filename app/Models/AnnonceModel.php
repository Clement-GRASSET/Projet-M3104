<?php

namespace App\Models;

use CodeIgniter\Model;

class AnnonceModel extends Model
{
    protected $table = 'T_annonce';
    protected $primaryKey = 'A_idannonce';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'A_titre',
        'A_cout_loyer',
        'A_cout_charges',
        'A_type_chauffage',
        'A_superficie',
        'A_description',
        'A_adresse',
        'A_ville',
        'A_CP',
        'A_etat'
    ];
}