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
        'M_iddiscussion'
    ];

    public function newMessage($message, $idannonce, $utilisateur)
    {
        $discussionModel = new DiscussionModel();
        $discussion = $discussionModel->where(['D_idannonce'=>$idannonce, 'D_utilisateur'=>$utilisateur])->first();
        if (empty($discussion)) {
            $discussion_data = [
                'D_idannonce' => $idannonce,
                'D_utilisateur' => $utilisateur,
                'D_non_lu_proprietaire' => false,
                'D_non_lu_utilisateur' => false
            ];
            $discussionModel->insert($discussion_data);
            $discussion = $discussionModel->where(['D_idannonce'=>$idannonce, 'D_utilisateur'=>$utilisateur])->first();
        }
        $discussionModel->update($discussion['D_iddiscussion'], ($message['M_envoyeur'] === $discussion['D_utilisateur']) ? ['D_non_lu_proprietaire'=>true] : ['D_non_lu_utilisateur'=>true]);
        $message['M_iddiscussion'] = $discussion['D_iddiscussion'];
        $this->insert($message);
    }
}