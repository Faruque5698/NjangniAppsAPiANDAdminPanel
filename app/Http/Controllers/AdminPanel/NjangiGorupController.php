<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\NjangiGorup;
use App\Models\NjangiGroupMember;
use Illuminate\Http\Request;

class NjangiGorupController extends Controller
{
    public function index(){
        $groups = NjangiGorup::all();
        return view('AdminPanel.NjangiGroups.NjangiGroups',[
            'groups' => $groups
        ]);
    }

    public function destroy($id){
        $group = NjangiGorup::find($id);


            unlink($group->group_image);
            $group->delete();

            return back()->with('message','Njangi Group Deleted Successfully');



    }

    public function njangi_group_members_list($id){
        $group = NjangiGorup::find($id);
        $members = NjangiGroupMember::with('members')->where('group_id','=',$id)->get();
        return view('AdminPanel.NjangiGroups.NjangiGoupsMembers',[
            'members' => $members,
            'group'=>$group
        ]);
    }

    public function member_details($id){
        $member = NjangiGroupMember::with('members','njangiGroup')->find($id);
        return view ('AdminPanel.NjangiGroups.Member_details',[
           'member'=>$member
        ]);
    }
}
