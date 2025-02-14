<?php


namespace App\Repositories\Auth;

use App\Interfaces\Auth\UserRepositoryInterface;
use App\Models\User;
use App\Models\TemporaryUser;
use App\Models\TemporaryUserLocation;
use App\Models\UserLocation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class UserRepository implements UserRepositoryInterface
{





    public function registerUser(array $data)
    {
        return DB::transaction(function () use ($data) {
            $tempUser = TemporaryUser::latest()->first();

            if (!$tempUser) {
                return ['error' => 'No verified phone number found'];
            }


            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone_number' => $tempUser->phone_number,
                'password' => Hash::make($data['password']),
            ]);

            $tempLocation = TemporaryUserLocation::where('phone_number', $tempUser->phone_number)->first();

            if ($tempLocation) {
                UserLocation::create([
                    'user_id' => $user->id,
                    'state_id' => $tempLocation->state_id,
                    'city_id' => $tempLocation->city_id,
                ]);
            }
            $tempUser->delete();
            $tempLocation?->delete();

            $token = $user->createToken('auth_token')->plainTextToken;

            return [
                'message' => 'User registered successfully',
                'token' => $token,
                'user' => $user
            ];
        });
    }

    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            return ['error' => 'Invalid credentials'];
        }

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return ['error' => 'User not found after authentication'];
        }

        $user->tokens()->delete();

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user
        ];
    }


    public function logout()
    {

        $user = auth('sanctum')->user();

        if (!$user) {
            return ['error' => 'Unauthorized'];
        }

        $user->tokens->each(function ($token) {
            $token->delete();
        });

        return ['message' => 'Logged out successfully'];
    }
}
