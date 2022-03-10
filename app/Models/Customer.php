<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticateContract;

class Customer extends Model
{
    use HasFactory,HasApiTokens;

    protected $fillable = [
        'name','email','password','phone_no'
    ];
}
