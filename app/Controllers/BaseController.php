<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    protected $session;

    protected $userInfo = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        $this->session = \Config\Services::session();

        $isLoggedIn = isset($this->session->user);
        $this->userInfo['isLoggedIn'] = $isLoggedIn;
        if ($isLoggedIn) {
            $utilisateurModel = new UtilisateurModel();
            $user = $utilisateurModel->find($this->session->user);
            $this->userInfo['loggedUser'] = $user;
        }
    }

    protected function showView(string $name, array $data = [], array $options = [])
    {
        $data = array_merge($data, $this->userInfo);
        echo view($name, $data, $options);
    }

    protected function sendMail(string $address, string $subject, string $content)
    {
        $email = \Config\Services::email();
        $email->setFrom('li.logement.fr@gmail.com', 'Li Logement');
        $email->setTo($address);
        $email->setSubject($subject);
        $email->setMessage($content);//your message here

        $email->send();
        $email->printDebugger(['headers']);
    }

}
