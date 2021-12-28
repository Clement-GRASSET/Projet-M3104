<?php

namespace App\Controllers;

use App\Models\AnnonceModel;
use App\Models\MessageModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Home extends BaseController
{
    public function index()
    {
        echo view('index.php');
    }

    public function homes()
    {
        $annonceModel = new AnnonceModel();
        $annonces = $annonceModel->findAll();
        echo view('homes.php', ['annonces'=>$annonces]);
    }

    public function home_details($id)
    {
        $annonceModel = new AnnonceModel();
        $annonce = $annonceModel->find($id);
        if (!isset($annonce)) {
            throw PageNotFoundException::forPageNotFound();
        }
        echo view('home_details.php', ['annonce'=>$annonce]);
    }

    public function home_contact($id)
    {
        $annonceModel = new AnnonceModel();
        $annonce = $annonceModel->find($id);
        if (!isset($annonce) || !isset($this->session->user)) {
            throw PageNotFoundException::forPageNotFound();
        }
        $valitation = $this->validate([
            'message' => [
                'rules' => 'required'
            ]
        ]);
        if ($valitation) {
            $messageModel = new MessageModel();
            $message = [
                'M_envoyeur' => $this->session->user,
                'M_texte_message' => $this->request->getPost('message'),
                'M_idannonce' => $id,
                'M_utilisateur' => $this->session->user
            ];
            $messageModel->insert($message);
            return redirect()->to('/homes/'.$id);
        } else {
            echo view('home_contact.php', ['annonce'=>$annonce]);
        }
    }
}
