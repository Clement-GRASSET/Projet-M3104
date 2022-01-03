<?php

namespace App\Models;

use CodeIgniter\Model;

class PhotoModel extends Model
{
    protected $table = 'T_photo';
    protected $primaryKey = 'P_id_photo';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'P_titre',
        'P_nom',
        'P_idannonce'
    ];
}
