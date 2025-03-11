<?php


namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function registerUser(array $data);

    public function loginUser(array $data);
    public function verifyEmail(array $data);
    public function logoutUser($user);
    public function sendResetCode(array $data);
    public function resetPassword(array $data);
}
