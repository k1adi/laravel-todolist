<?php

namespace App\Services;

// Membuat kontrak user service untuk business logic
interface UserService
{
    function login(string $user, string $password): bool;
}