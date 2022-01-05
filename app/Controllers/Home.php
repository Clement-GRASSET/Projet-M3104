<?php

namespace App\Controllers;

use App\Models\AnnonceModel;
use App\Models\DiscussionModel;
use App\Models\MessageModel;
use App\Models\PhotoModel;
use App\Models\TypeMaisonModel;
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
        $this->showView('index.php', $data);
    }

    public function homes()
    {
        $numPage = ($this->request->getGet('page')) ? $this->request->getGet('page') : '1';
        if ($numPage < 1 || !filter_var($numPage, FILTER_VALIDATE_INT))
            throw PageNotFoundException::forPageNotFound();
        $numPage = (int) $numPage;

        $annonceModel = new AnnonceModel();

        $filter = [];

        if ($this->request->getGet('adresse'))
            $filter['A_adresse'] = $this->request->getGet('adresse');

        if ($this->request->getGet('ville'))
            $filter['A_ville'] = $this->request->getGet('ville');

        if ($this->request->getGet('type_maison'))
            $filter['A_type_maison'] = $this->request->getGet('type_maison');

        /*        if ($this->request->getGet('superficie'))
                    $filter['A_superficie'] = $this->request->getGet('superficie');*/

        if ($this->request->getGet('type_chauffage'))
            $filter['A_type_chauffage'] = $this->request->getGet('type_chauffage');

        $nbAnnonces = $annonceModel->where(['A_etat'=>'publiée'])->like($filter)->countAllResults();

        $limit = 15;
        $nbPages = intdiv($nbAnnonces, $limit) + 1;
        $offset = ($numPage - 1) * $limit;
        if ($offset >= $nbAnnonces && $numPage != 1)
            throw PageNotFoundException::forPageNotFound();

        $annonces = $annonceModel
            ->orderBy('A_idannonce', 'desc')
            ->where(['A_etat'=>'publiée'])
            ->like($filter)
            ->findAll($limit, $offset);

        $typeMaisonModel = new TypeMaisonModel();
        $typesMaison = $typeMaisonModel->findAll();

        $data = [
            'annonces'=>[],
            'numPage'=>$numPage,
            'nbPages'=>$nbPages,
            'filter'=>$filter,
            'typesMaison'=>$typesMaison,
        ];
        foreach ($annonces as $annonce) {
            $data['annonces'][] = $annonceModel->addData($annonce);
        }
        $data = array_merge($data, $this->userInfo);
        $this->showView('homes.php', $data);
    }

    public function home_details($id)
    {
        $annonceModel = new AnnonceModel();
        $annonce = $annonceModel->where(['A_etat'=>'publiée'])->find($id);
        if (!isset($annonce)) {
            throw PageNotFoundException::forPageNotFound();
        }
        $data = ['annonce'=>$annonceModel->addData($annonce)];
        $data = array_merge($data, $this->userInfo);
        $this->showView('home_details.php', $data);
    }

    public function home_contact($id)
    {
        $annonceModel = new AnnonceModel();
        $annonce = $annonceModel->where(['A_etat'=>'publiée'])->find($id);
        if (!isset($annonce) || !isset($this->session->user) || $annonce['A_proprietaire'] === $this->session->user) {
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
            ];
            $messageModel->newMessage($message, $id, $this->session->user);
            $discussionModel = new DiscussionModel();
            $discussion = $discussionModel->where(['D_idannonce'=>$id, 'D_utilisateur'=> $this->session->user])->first();
            return redirect()->to('/account/messages/'.$discussion['D_iddiscussion']);
        } else {
            $data = ['annonce'=>$annonce];
            $data = array_merge($data, $this->userInfo);
            $this->showView('home_contact.php', $data);
        }
    }

    public function home_photo($idannonce)
    {
        $annonceModel = new AnnonceModel();
        $annonce = $annonceModel->where(['A_etat'=>'publiée'])->find($idannonce);
        if (!isset($annonce))
            throw PageNotFoundException::forPageNotFound();

        $idphoto = $this->request->getGet('id');
        $photoModel = new PhotoModel();
        $photo = $photoModel->where(['P_idannonce'=>$idannonce, 'P_id_photo'=>$idphoto])->first();
        if (!isset($photo))
            throw PageNotFoundException::forPageNotFound();

        $photos = $photoModel->where(['P_idannonce'=>$idannonce])->findAll();

        $data = ['photo'=>$photo, 'photos'=>$photos, 'annonce'=>$annonce];
        $data = array_merge($data, $this->userInfo);

        $this->showView('home_photo', $data);

    }
}
