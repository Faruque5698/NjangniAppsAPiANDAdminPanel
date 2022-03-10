<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NjangiGorup extends Model
{
    use HasFactory;
    protected $fillable = ['creator_id','group_name','group_image','contribution_amount','contribution_level','status'];

    public function njangiGroupMembers(){
        return $this->hasMany(NjangiGroupMember::class);
    }
    public function njangiCreator(){
        return $this->belongsTo(User::class,'creator_id');
    }
}
