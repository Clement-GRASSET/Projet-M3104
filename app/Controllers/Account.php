<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Account extends BaseController
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

    public function messages()
    {
        echo view("account/account", ["content"=>view('account/messages')]);
    }

    public function homes()
    {
        echo view("account/account", ["content"=>view('account/homes')]);
    }

    public function settings() {
        $utilisateurModel = new UtilisateurModel();
        $user = $utilisateurModel->find($this->session->user);
        echo view("account/account", ["content"=>view('account/settings', ["user" => $user])]);
    }

    public function delete() {
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
                echo view("account/account", ["content"=>view('account/delete')]);
            }
        } else {
            echo view("account/account", ["content"=>view('account/delete')]);
        }
    }
}