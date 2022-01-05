<?php

namespace App\Filters;

use App\Classes\DatabaseUtils;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Config implements FilterInterface {

    public function before(RequestInterface $request, $arguments = null)
    {
        $databaseUtils = new DatabaseUtils();
        if ($databaseUtils->isValid())
            throw PageNotFoundException::forPageNotFound();
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}