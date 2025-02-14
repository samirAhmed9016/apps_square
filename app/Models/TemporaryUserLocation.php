<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryUserLocation extends Model
{
    use HasFactory;

    protected $fillable = ['phone_number', 'state_id', 'city_id'];

    public function temporaryUser()
    {
        return $this->belongsTo(TemporaryUser::class, 'phone_number', 'phone_number');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
