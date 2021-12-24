<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class BackOfficeController extends BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        if (!isset($this->session->user)) {
            $response->redirect("/login");
            $response->send();
            exit();
        }
    }

    public function account() {
        $utilisateurModel = new UtilisateurModel();
        $user = $utilisateurModel->find($this->session->user);
        echo view("my_account", ["user" => $user]);
    }

    public function delete_account() {
        $validation = $this->validate([
            "email_confirm" => [
                "rules" => "required"
            ]
        ]);
        if ($validation) {
            if ($this->session->user === $this->request->getPost("email_confirm")) {
                $utilisateurModel = new UtilisateurModel();
                $utilisateurModel->delete($this->session->user);
                return redirect()->to("/logout");
            } else {
                echo view("delete_account");
            }
        } else {
            echo view("delete_account");
        }
    }
}