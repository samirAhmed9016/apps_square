<?php



namespace App\Repositories;

use App\Models\User;
use App\Models\VerificationCode;
use App\Interfaces\VerificationCodeRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class VerificationCodeRepository implements VerificationCodeRepositoryInterface
{

    // 1️⃣ Generate and send a verification code
    public function generateCode(int $user_id)
    {
        $code = Str::random(6);

        VerificationCode::updateOrCreate(
            ['user_id' => $user_id],
            ['code' => $code, 'expires_at' => now()->addMinutes(10)]
        );

        // Send email (You need to set up email configurations in .env)
        Mail::raw("Your verification code is: $code", function ($message) use ($user_id) {
            $message->to(User::find($user_id)->email)
                ->subject("Email Verification Code");
        });
    }

    public function validateCode(string $email, string $code)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return false;
        }

        $verification = VerificationCode::where('user_id', $user->id)
            ->where('code', $code)
            ->where('expires_at', '>', now())
            ->first();

        return $verification ? true : false;
    }
}
