<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Database;

class DatabaseCheck implements FilterInterface {

    public function before(RequestInterface $request, $arguments = null)
    {
        $db = Database::connect();
        $query = $db->query("show tables");
        $results = array_values($query->getResultArray());
        $tables = [];
        foreach ($results as $table) {
            $tables[] = array_values($table)[0];
        }
        if (!(
            in_array('T_annonce', $tables) &&
            in_array('T_discussion', $tables) &&
            in_array('T_energie', $tables) &&
            in_array('T_message', $tables) &&
            in_array('T_photo', $tables) &&
            in_array('T_typeMaison', $tables) &&
            in_array('T_utilisateur', $tables)
        )) {
            echo 'Base de données cassée';
            exit();
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}