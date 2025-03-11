<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\VerifyEmailRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;
use Spatie\Fractal\Fractal;


class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        return $this->userRepository->registerUser($request->validated());
    }
    public function verifyEmail(VerifyEmailRequest $request): JsonResponse
    {
        return $this->userRepository->verifyEmail($request->validated());
    }
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->userRepository->loginUser($request->validated());
    }
    public function logout(Request $request): JsonResponse
    {
        return $this->userRepository->logoutUser($request->user());
    }
    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        return $this->userRepository->sendResetCode($request->validated());
    }
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        return $this->userRepository->resetPassword($request->validated());
    }


    public function show($id)
    {
        $user = User::findOrFail($id);

        return fractal()
            ->item($user)
            ->transformWith(new UserTransformer())
            ->respond();
    }
}
