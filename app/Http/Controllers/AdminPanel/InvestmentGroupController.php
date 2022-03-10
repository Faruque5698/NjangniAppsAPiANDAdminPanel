<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\InvestmentGroup;
use App\Models\InvestmentGroupMember;
use Illuminate\Http\Request;

class InvestmentGroupController extends Controller
{
    public function index(){
        $groups = InvestmentGroup::all();
        return view('AdminPanel.investment.investment',[
            'groups' => $groups
        ]);
    }
    public function invest_group_members_list($id){
        $group = InvestmentGroup::find($id);
        $members = InvestmentGroupMember::with('invest_members')->where('group_id','=',$id)->get();
        return view('AdminPanel.investment.investmentGoupsMembers',[
            'members' => $members,
            'group'=>$group
        ]);
    }
    public function member_details($id){
        $member = InvestmentGroupMember::with('invest_members','investmentGroup')->find($id);
        return view ('AdminPanel.investment.Member_details',[
            'member'=>$member
        ]);
    }
}
