<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'mobile', 'password', 'otp', 'is_verified', 'logo_url'];
    
    // Set Default Value
    protected $attributes = [
        'otp' => '0',
        'is_verified' => '0',
        'logo_url' => ''
    ];
}