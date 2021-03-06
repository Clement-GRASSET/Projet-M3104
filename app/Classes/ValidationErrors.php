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
            return "<p class='validation_error'>" . $this->errors[$field] . "</p>";
        else
            return "";
    }

}