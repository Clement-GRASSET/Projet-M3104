<?php

namespace App\Models;

use CodeIgniter\Model;

class DiscussionModel extends Model
{
    protected $table = 'T_discussion';
    protected $primaryKey = 'D_iddiscussion';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'D_idannonce',
        'D_utilisateur',
        'D_non_lu_proprietaire',
        'D_non_lu_utilisateur',
    ];
}