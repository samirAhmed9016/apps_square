<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryUser extends Model
{
    use HasFactory;


    protected $fillable = ['phone_number'];

    public function temporaryUserLocation()
    {
        return $this->hasOne(TemporaryUserLocation::class, 'phone_number', 'phone_number');
    }
}
