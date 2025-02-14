<?php

namespace App\Interfaces\Auth;

interface OTPRepositoryInterface
{
    public function sendOTP(string $phone): array;
    public function verifyOTP(string $phone, string $otp): array;
}
