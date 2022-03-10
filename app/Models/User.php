<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $url= ' http://127.0.0.1:8000/reset-password?token=' . $token;
        $this->notify(new ResetPasswordNotification($url));
    }

    public function njangiGroupMembers(){
        return $this->hasMany(NjangiGroupMember::class);
    }
    public function investmentGroupMembers(){
        return $this->hasMany(InvestmentGroupMember::class);
    }
    public function njangiGroups(){
        return $this->hasOne(NjangiGorup::class);
    }
    public function investGroups(){
        return $this->hasOne(InvestmentGroup::class);
    }
}
