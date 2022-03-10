<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InvestmentGroup;
use App\Models\InvestmentGroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Image;

class InvestmentGroupController extends Controller
{
    public function create_investment_group(Request $request){
        $request->validate([
            'group_name'=>'required|unique:investment_groups',
            'contribution_amount'=>'required',
            'contributional_interval'=>'required',
            'group_image'=>'required|image'
        ]);
//        $g_name = $request->group_name."_Njangi";
//        $image = $request->file('group_image');
//        $data = [
//            'name'=>$request->group_name,
//            'a'=>$request->contribution_amount,
//            'b'=>$request->contribution_level,
//            'c'=>$request->$image
//        ];


        $group_name = $request->group_name."_investment";

        $groups = new InvestmentGroup();

        $group_image = $request->file('group_image');
        $imageName = $group_image->getClientOriginalName();
        $directory = 'assets/image/investment_group_image/';
        $imageUrl = $directory.$imageName;
//        $group_image -> move($directory,$imageName);

        Image::make($group_image)->resize(512,512)->save($imageUrl);


        $groups->creator_id = auth()->user()->id;
        $groups->group_name = $request->group_name;
        $groups->contribution_amount = $request->contribution_amount;
        $groups->contributional_interval = $request->contributional_interval;
        $groups->group_image = $imageUrl;



        Schema::create($group_name,function ($table){
            $table->increments('id');
            $table->unsignedBigInteger('group_id');
            $table->string('group_name');
            $table->text('message');
            $table->unsignedBigInteger('sender_id');
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('investment_groups')->onDelete('CASCADE');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('CASCADE');
        });

        $groups->save();


        $member = new InvestmentGroupMember();
        $member->group_id = $groups->id;
        $member->members_id = auth()->user()->id;
        $member->role = 'admin';
        $member->save();

        $members = InvestmentGroupMember::where('group_id','=',$groups->id)->get();

        return response()->json([
            'status'=>true,
            'message'=>"New Group Created Successfully",
            'data'=>$groups,
            'all members' => $members
        ]);
    }

    public function investment_group_list(){
        $user_id = auth()->user()->id;
        $groups = InvestmentGroup::where('creator_id','=',$user_id)->get();

        return response()->json([
            'status'=>true,
            'groups'=>$groups
        ]);
    }

    public function i_am_in_investment_group_list(){
        $user_id = auth()->user()->id;
        $groups = InvestmentGroupMember::with('investmentGroup')->where('members_id','=',$user_id)->get();

        return response()->json([
            'status'=>true,
            'groups'=>$groups,
            'user'=>auth()->user()
        ]);



    }

    public function all_investment_group_list(){
        $user_id = auth()->user()->id;
        $groups = InvestmentGroup::where('status','=','active')->get();

        return response()->json([
            'status'=>true,
            'groups'=>$groups
        ]);
    }

    public function destroy($id){
        $group = InvestmentGroup::find($id);
        $user = auth()->user()->id;

        $group_name = $group->group_name."_investment";


//        return auth()->user()->id;


        if ($group->creator_id == $user)
        {
            unlink($group->group_image);
            Schema::drop($group_name);
            $group->delete();


            return response()->json([
                'status' => true,
                'message' => "Investment group deleted successfully",
                'deleted_by'=>auth()->user()
            ]);
        }
        else{
            return response()->json([
                'status'=>false,
                'message'=>'You do not have access to delete it'
            ]);
        }

        return response()->json([
            'status'=>false,
            'message'=>'Error do not have group'
        ]);
    }

    public function add_investment_group_members($group_id, Request $request){
        $group = InvestmentGroup::find($group_id);
        $user= auth()->user()->id;

        $admins = InvestmentGroupMember::where('group_id','=',$group_id)->Where('role','=','admin')->get();


        $checker = InvestmentGroupMember::where('group_id','=',$group_id)->where('members_id','=',$request->members_id)->get();

//        return response(['member'=>$checker]);

        if($checker->isEmpty()){

            foreach ($admins as $admin){
                if ($admin->members_id == $user){
                    $request->validate([
                        'members_id' => 'required'
                    ]);

                    $group_member = new InvestmentGroupMember();

                    $group_member->group_id = $group_id;
                    $group_member->members_id = $request->members_id;
                    $group_member->role = 'members';
                    $group_member->save();

                    $members = InvestmentGroupMember::where('group_id','=',$group_id)->get();


                    return response()->json([
                        'status'=>true,
                        'message'=>"New Group Member Added Successfully",
                        'new_member_details'=>$group_member,
                        'group_details'=>$group,
                        'group_all_members'=>$members,
                        'Added_by'=>auth()->user()
                    ]);
                }
            }


            return response()->json([
                'status'=>false,
                "message"=>"You are not admin",
                'group_details'=>$group
            ]);
        }else{
            $members = InvestmentGroupMember::where('group_id','=',$group_id)->get();
            return response()->json([

                'status'=>false,
                'message'=>"This member all ready in this group",
                'group_details'=>$group,
                'members'=>$members
            ]);
        }


    }

    public function investment_group_members_list($group_id){
        $group = InvestmentGroup::find($group_id);
        $user = auth()->user()->id;

        $group_members = InvestmentGroupMember::with('invest_members','investmentGroup')->where('group_id','=',$group_id)->get();
        return response()->json([
            'status'=>true,
            'data'=>$group_members
        ]);
    }

    public function investment_member_details($id){
        $member = InvestmentGroupMember::with('invest_members','investmentGroup')->find($id);
       return response()->json([
            'status'=>true,
           'data'=>$member
        ]);
    }

    public function investment_member_remove($member_id,$group_id){
        $admins = InvestmentGroupMember::where('group_id','=',$group_id)->Where('role','=','admin')->get();

        $group_members = InvestmentGroupMember::where('members_id','=',$member_id)->get();

        foreach ($group_members as $member)
            $id = $member->group_id;



        $user = auth()->user()->id;

        $group = InvestmentGroup::find($id);

        if ($group->creator_id == $user){
            $member -> delete();

            return response()->json([
                'status'=>true,
                'message'=>"Member Removed Successfully"
            ]);
        }else{
            return response([
                'status'=>false,
                'message'=>'You do not have access to remove member'
            ]);
        }

    }

}
