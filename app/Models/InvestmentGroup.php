<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentGroup extends Model
{
    use HasFactory;

    public function investmentGroupMembers(){
        return $this->hasMany(InvestmentGroupMember::class);
    }
    public function investCreator(){
        return $this->belongsTo(User::class,'creator_id');
    }

}
