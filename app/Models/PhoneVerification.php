<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneVerification extends Model
{
    use HasFactory;

    protected $fillable = ['phone', 'otp', 'expires_at'];
    public function isExpired()
    {
        return Carbon::now()->greaterThan($this->expires_at);
    }
}
