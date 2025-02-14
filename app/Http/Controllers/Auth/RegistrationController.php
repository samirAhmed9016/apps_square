<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Interfaces\Auth\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;

class RegistrationController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->userRepository->registerUser($request->validated());

        return response()->json($result);
    }

    public function login(LoginRequest $request)
    {
        return response()->json($this->userRepository->login($request->validated()));
    }

    public function logout()
    {
        return response()->json($this->userRepository->logout());
    }
}
