<?php

namespace App\Controllers;

use App\Models\AnnonceModel;
use App\Models\MessageModel;
use App\Models\UtilisateurModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Home extends BaseController
{
    public function index()
    {
        $annonceModel = new AnnonceModel();
        $annonces = $annonceModel->findAll(6);
        $isLoggedIn = isset($this->session->user);
        $data = [
            'isLoggedIn' => $isLoggedIn,
            'annonces' => $annonces
        ];
        if ($isLoggedIn) {
            $utilisateurModel = new UtilisateurModel();
            $user = $utilisateurModel->find($this->session->user);
            $data['user'] = $user;
        }
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


        /*
        echo "</br><h2>Partie dans le controleur :</h2></br>";
        echo "<p>Mettre 'page' en parametre post de la page</br>Exemple : localhost:8080/homes?page=2</p></br>";
        echo "nb annonces : " . $nbAnnonces . "/15<br/>";
        echo "nb pages : " . $nbPages . "</br>";
        echo "num pages : " . ($numPage) . "</br>";
        */

        $nbPages = intdiv($nbAnnonces, 15) + 1;
        $offset = ($numPage - 1) * 15;
        if ($offset >= $nbAnnonces && $numPage != 1)
            throw PageNotFoundException::forPageNotFound();

        $annonces = $annonceModel
            ->orderBy('A_idannonce', 'desc')
            ->where(['A_etat'=>'publiée'])
            ->findAll(15, $offset);

        /*echo "<br/>annonces :<br/>";
        foreach ($annonces as $annonce) {
            echo "<br/>";
            var_dump($annonce);
            echo "<br/>";
        }
        echo "</br><h2>Fin de la partie dans le controleur</h2></br>";*/

        echo view('homes.php', [
            'annonces'=>$annonces,
            'numPage'=>$numPage,
            'nbPages'=>$nbPages,
        ]);
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
