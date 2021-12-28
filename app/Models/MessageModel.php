<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table = 'T_message';
    protected $primaryKey = 'M_envoyeur';
    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'M_envoyeur',
        'M_texte_message',
        'M_idannonce',
        'M_utilisateur'
    ];

    public function insert($data = null, bool $returnID = true)
    {

        $discussionModel = new DiscussionModel();
        $discussion = $discussionModel->where(['D_idannonce'=>$data['M_idannonce'], 'D_utilisateur'=>$data['M_utilisateur']])->find();
        if (empty($discussion)) {
            $discussion_data = [
                'D_idannonce' => $data['M_idannonce'],
                'D_utilisateur' => $data['M_utilisateur'],
                'D_non_lu_proprietaire' => false,
                'D_non_lu_utilisateur' => false
            ];
            $discussionModel->insert($discussion_data);
        }
        return parent::insert($data, $returnID);
    }
}