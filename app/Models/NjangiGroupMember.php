<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NjangiGroupMember extends Model
{
    use HasFactory;

    protected $fillable = ['group_id','members_id'];

    public function members(){
        return $this->belongsTo(User::class,'members_id');
    }
    public function njangiGroup(){
        return $this->belongsTo(NjangiGorup::class,'group_id');
    }

}
