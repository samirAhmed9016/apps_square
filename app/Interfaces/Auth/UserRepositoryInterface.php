<?php

namespace App\Interfaces\Auth;

interface UserRepositoryInterface
{

    public function registerUser(array $data);
    public function login(array $credentials);
    public function logout();
}
