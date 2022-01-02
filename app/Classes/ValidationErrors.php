<?php

namespace App\Classes;

class ValidationErrors {

    public $errors;

    public function __construct($errors)
    {
        $this->errors = $errors;
    }

    function html(string $field) : string
    {
        if (isset($this->errors[$field]))
            return "<p class='txterror'>" . $this->errors[$field] . "</p>";
        else
            return "";
    }

}