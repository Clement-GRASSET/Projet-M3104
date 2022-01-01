<?php

namespace App\Models;

use CodeIgniter\Model;

class EnergieModel extends Model
{
    protected $table = 'T_energie';
    protected $primaryKey = 'E_id_engie';
    protected $useAutoIncrement = true;
    protected $allowedFields = [

    ];
}