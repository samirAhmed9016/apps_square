<?php

namespace App\Repositories\Auth;

use App\Interfaces\Auth\OTPRepositoryInterface;
use App\Models\PhoneVerification;
use App\Models\TemporaryUser;
use Illuminate\Support\Facades\Log;


class OTPRepository implements OTPRepositoryInterface
{
    public function sendOTP(string $phone): array
    {
        $otp = rand(100000, 999999);
        $expiresAt = now()->addMinutes(1);

        PhoneVerification::updateOrCreate(
            ['phone' => $phone],
            ['otp' => $otp, 'expires_at' => $expiresAt]
        );

        // instead of send otp via sms
        Log::info("OTP for {$phone} is: {$otp}");

        return ['message' => 'OTP sent successfully'];
    }




    public function verifyOTP(string $phone, string $otp): array
    {
        $verification = PhoneVerification::where('phone', $phone)
            ->where('otp', $otp)
            ->first();

        if (!$verification) {
            return ['error' => 'Invalid OTP'];
        }

        if ($verification->isExpired()) {
            return ['error' => 'OTP expired'];
        }


        TemporaryUser::updateOrCreate(['phone_number' => $phone]);

        $verification->delete();

        return [
            'message' => 'Phone number verified successfully. Please select your location.',
            'next_step' => 'select_location'
        ];
    }
}
