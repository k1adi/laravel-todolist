<?php

namespace App\Services\Implementation;

use App\Services\UserService;

// Implementasi business logic dari user service interface
class UserServiceImplementation implements UserService
{
    private $users = [
        "rizki" => "asd123"
    ];

    function login(string $user, string $password): bool
    {
        if(!isset($this->users[$user])) {
            return false;
        }

        $correctPassword = $this->users[$user];
        
        return $password == $correctPassword;
    }
}