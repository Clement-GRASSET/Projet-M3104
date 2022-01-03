<?php

namespace App\Controllers;

use App\Models\AnnonceModel;
use App\Models\MessageModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Home extends BaseController
{
    public function index()
    {
        $annonceModel = new AnnonceModel();
        $annonces = $annonceModel
            ->orderBy('A_idannonce', 'desc')
            ->where(['A_etat'=>'publiée'])
            ->findAll(6);

        $data = [
            'annonces' => []
        ];
        foreach ($annonces as $annonce) {
            $data['annonces'][] = $annonceModel->addData($annonce);
        }
        $data = array_merge($data, $this->userInfo);
        echo view('index.php', $data);
    }

    public function homes()
    {
        $numPage = ($this->request->getGet('page')) ? $this->request->getGet('page') : '1';
        if ($numPage < 1 || !filter_var($numPage, FILTER_VALIDATE_INT))
            throw PageNotFoundException::forPageNotFound();
        $numPage = (int) $numPage;

        $annonceModel = new AnnonceModel();
        $nbAnnonces = $annonceModel->where(['A_etat'=>'publiée'])->countAllResults();

        $nbPages = intdiv($nbAnnonces, 15) + 1;
        $offset = ($numPage - 1) * 15;
        if ($offset >= $nbAnnonces && $numPage != 1)
            throw PageNotFoundException::forPageNotFound();

        $annonces = $annonceModel
            ->orderBy('A_idannonce', 'desc')
            ->where(['A_etat'=>'publiée'])
            ->findAll(15, $offset);

        $data = [
            'annonces'=>[],
            'numPage'=>$numPage,
            'nbPages'=>$nbPages,
        ];
        foreach ($annonces as $annonce) {
            $data['annonces'][] = $annonceModel->addData($annonce);
        }
        $data = array_merge($data, $this->userInfo);
        echo view('homes.php', $data);
    }

    public function home_details($id)
    {
        $annonceModel = new AnnonceModel();
        $annonce = $annonceModel->find($id);
        if (!isset($annonce)) {
            throw PageNotFoundException::forPageNotFound();
        }
        $data = ['annonce'=>$annonce];
        $data = array_merge($data, $this->userInfo);
        echo view('home_details.php', $data);
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
            $data = ['annonce'=>$annonce];
            $data = array_merge($data, $this->userInfo);
            echo view('home_contact.php', $data);
        }
    }
}
