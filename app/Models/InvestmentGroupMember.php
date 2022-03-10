<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentGroupMember extends Model
{
    use HasFactory;
    public function invest_members(){
        return $this->belongsTo(User::class,'members_id');
    }
    public function investmentGroup(){
        return $this->belongsTo(InvestmentGroup::class,'group_id');
    }
}
