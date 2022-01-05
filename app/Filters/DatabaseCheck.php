<?php

namespace App\Filters;

use App\Classes\DatabaseUtils;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class DatabaseCheck implements FilterInterface {

    public function before(RequestInterface $request, $arguments = null)
    {
        $databaseUtils = new DatabaseUtils();
        if (!$databaseUtils->isValid()) {
            return redirect()->to('/config');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}