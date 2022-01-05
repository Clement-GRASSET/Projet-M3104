<?php

namespace App\Controllers;

use Config\Database;

class Config extends BaseController
{
    public function index()
    {
        var_dump($this->isDatabaseEmpty());
        echo "hello";
    }

    private function createTables()
    {
        $db = Database::connect();
        $db->query($this->sql_script);
    }
}
