<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\VerificationCodeRepositoryInterface;
use App\Mail\ResetPasswordMail;
use App\Mail\VerifyMail;
use App\Models\PasswordReset;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class UserRepository implements UserRepositoryInterface
{
    protected $verificationCodeRepository;



    public function registerUser(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);


        $verificationCode = mt_rand(100000, 999999);


        VerificationCode::create([
            'user_id' => $user->id,
            'code' => $verificationCode,
            'expires_at' => now()->addMinutes(10),
        ]);


        Mail::to($user->email)->send(new VerifyMail($verificationCode));

        return response()->json([
            'message' => 'User registered successfully. A verification code has been sent.',
            'user_id' => $user->id,
        ]);
    }


    public function verifyEmail(array $data)
    {
        $verificationCode = VerificationCode::where('code', $data['code'])
            ->whereHas('user', function ($query) use ($data) {
                $query->where('email', $data['email']);
            })
            ->where('expires_at', '>', now())
            ->first();

        if (!$verificationCode) {
            return response()->json(['message' => 'Invalid or expired verification code.'], 400);
        }

        $user = User::where('email', $data['email'])->first();
        $user->email_verified_at = now();
        $user->save();

        $verificationCode->delete();

        return response()->json(['message' => 'Email verified successfully.'], 200);
    }


    public function loginUser(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Invalid email or password.'], 401);
        }

        if (!$user->email_verified_at) {
            return response()->json(['message' => 'Please verify your email before logging in.'], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful.',
            'token' => $token,
            'user' => $user
        ], 200);
    }

    public function logoutUser($user)
    {
        $user->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully.'], 200);
    }



    public function sendResetCode(array $data)
    {
        $email = $data['email'];

        // Generate a unique reset token
        $resetToken = Str::random(6);

        // Save reset token in database
        PasswordReset::updateOrCreate(
            ['email' => $email],
            ['token' => $resetToken, 'created_at' => now()]
        );

        // Send the reset code via email
        Mail::to($email)->send(new ResetPasswordMail($resetToken));

        return response()->json(['message' => 'Password reset code sent to your email.'], 200);
    }

    public function resetPassword(array $data)
    {
        $email = $data['email'];
        $code = $data['code'];
        $newPassword = Hash::make($data['password']);

        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('token', $code)
            ->first();

        if (!$resetRecord) {
            return response()->json(['message' => 'Invalid reset code.'], 400);
        }


        User::where('email', $email)->update(['password' => $newPassword]);


        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return response()->json(['message' => 'Password reset successfully.'], 200);
    }
}
