<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Passenger extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'passengers';

    protected $fillable = [
        'email', 'password', 'name', 'gender', 'contactNo', 'studentCardExpDate', 'studentCard', 'profileImg', 'passengerStatus'
    ];
}
