<?php

namespace App\Models;

class User
{
    public $firstname;
    public $lastname;
    public $email;

    public function __construct($firstname, $lastname, $email)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
    }
}