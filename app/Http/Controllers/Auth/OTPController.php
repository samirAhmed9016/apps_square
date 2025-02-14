<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendOTPRequest;
use App\Http\Requests\Auth\VerifyOTPRequest;
use App\Interfaces\Auth\OTPRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OTPController extends Controller
{
    protected $otpRepository;

    public function __construct(OTPRepositoryInterface $otpRepository)
    {
        $this->otpRepository = $otpRepository;
    }

    public function sendOTP(SendOTPRequest $request)
    {
        return response()->json($this->otpRepository->sendOTP($request->phone));
    }

    public function verifyOTP(VerifyOTPRequest $request)
    {
        return response()->json($this->otpRepository->verifyOTP($request->phone, $request->otp));
    }
}
