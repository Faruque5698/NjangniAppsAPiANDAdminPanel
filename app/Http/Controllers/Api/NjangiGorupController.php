<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NjangiGorup;
use App\Models\NjangiGroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Image;


class NjangiGorupController extends Controller
{
    public function create (Request $request){
        $request->validate([
            'group_name'=>'required|unique:njangi_gorups',
            'contribution_amount'=>'required',
            'contribution_level'=>'required',
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
        $groups = new NjangiGorup();

        $group_image = $request->file('group_image');
        $imageName = $group_image->getClientOriginalName();
        $directory = 'assets/image/group_image/';
        $imageUrl = $directory.$imageName;
//        $group_image -> move($directory,$imageName);
       Image::make($group_image)->resize(512,512)->save($imageUrl);


        $groups->creator_id = auth()->user()->id;
        $groups->group_name = $request->group_name;
        $groups->contribution_amount = $request->contribution_amount;
        $groups->contribution_level = $request->contribution_level;
        $groups->group_image = $imageUrl;



        Schema::create($request->group_name,function ($table){
            $table->increments('id');
            $table->unsignedBigInteger('group_id');
            $table->string('group_name');
            $table->text('message');
            $table->unsignedBigInteger('sender_id');
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('njangi_gorups')->onDelete('CASCADE');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('CASCADE');
        });

        $groups->save();



        $member = new NjangiGroupMember();
        $member->group_id = $groups->id;
        $member->members_id = auth()->user()->id;
        $member->role = 'admin';
        $member->save();

        $members = NjangiGroupMember::where('group_id','=',$groups->id)->get();


        return response()->json([
            'status'=>true,
            'message'=>"New Group Created Successfully",
            'data'=>$groups,
            'members'=>$members
        ]);
    }

    public function destroy($id){
        $group = NjangiGorup::find($id);
        $user = auth()->user()->id;


//        return auth()->user()->id;


        if ($group->creator_id == $user)
        {
            unlink($group->group_image);
            $group_name = $group->group_name;
            Schema::drop($group_name);
            $group->delete();


            return response()->json([
                'status' => true,
                'message' => "Njangi group deleted successfully",
                'Deleted_By'=>auth()->user()
            ]);
        }
        else{
            return response()->json([
                'status'=>false,
                'message'=>'You do not have access to delete it',
                'user'=>auth()->user()
            ]);
        }

        return response()->json([
            'status'=>false,
            'message'=>'Error do not have group'
        ]);

    }


    public function njangi_group_list(){
        $user_id = auth()->user()->id;
        $groups = NjangiGorup::where('creator_id','=',$user_id)->get();

        return response()->json([
           'status'=>true,
           'groups'=>$groups,
            'user'=>auth()->user()
        ]);

    }

    public function i_am_in_njangi_group_list(){
        $user_id = auth()->user()->id;
        $groups = NjangiGroupMember::with('njangiGroup')->where('members_id','=',$user_id)->get();

        return response()->json([
           'status'=>true,
           'groups'=>$groups,
           'user'=>auth()->user()
        ]);



    }

    public function all_njangi_group_list(){

        $groups = NjangiGorup::where('status','=','active')->get();

        return response()->json([
           'status'=>true,
           'groups'=>$groups,
            'user'=>auth()->user()
        ]);
    }

    public function add_njangi_group_members($group_id , Request $request){

        $group = NjangiGorup::find($group_id);
        $user= auth()->user()->id;

        $admins = NjangiGroupMember::where('group_id','=',$group_id)->Where('role','=','admin')->get();
//        return response(['admin'=>$admin]);

        $checker = NjangiGroupMember::where('group_id','=',$group_id)->where('members_id','=',$request->members_id)->get();

//        return response(['member'=>$checker]);

        if($checker->isEmpty()) {

            foreach ($admins as $admin) {
                if ($admin->members_id == $user) {
                    $request->validate([
                        'members_id' => 'required'
                    ]);

                    $group_member = new NjangiGroupMember();

                    $group_member->group_id = $group_id;
                    $group_member->members_id = $request->members_id;
                    $group_member->save();

                    $members = NjangiGroupMember::with('members', 'njangiGroup')->where('members_id', '=', $request->members_id)->get();

                    return response()->json([
                        'status' => true,
                        'message' => "New Group Member Added Successfully",
                        'Added_By' => auth()->user(),
                        'New_Member_Details' => $group_member,
                        'group_details' => $group,
                        'group_members_list' => $members
                    ]);
                }


            }

            return response()->json([
                'status' => false,
                "message" => "You are not admin",
                'group_details' => $group

            ]);
        }else{
            $members = NjangiGroupMember::where('group_id','=',$group_id)->get();
            return response()->json([

                'status'=>false,
                'message'=>"This member all ready in this group",
                'group_details'=>$group,
                'members'=>$members
            ]);
        }

    }

    public function njangi_group_members_list($group_id){
        $group = NjangiGorup::find($group_id);
        $user = auth()->user()->id;

            $group_members = NjangiGroupMember::with('members','njangiGroup')->where('group_id','=',$group_id)->get();
            return response()->json([
                'status'=>true,
                'data'=>$group_members,
                'user'=>auth()->user()
            ]);
        }




    public function member_details($id){
        $member = NjangiGroupMember::with('members','njangiGroup')->find($id);
        return response()->json([
            'status'=>true,
            'data'=>$member,
            'user'=>auth()->user()
        ]);
    }

    public function member_remove($member_id,$group_id){

        $admins = NjangiGroupMember::where('group_id','=',$group_id)->Where('role','=','admin')->get();

        foreach ($admins as $admin){
            if ($admin->members_id == auth()->user()->id){

                $group_members = NjangiGroupMember::where('members_id','=',$member_id)->get();

                foreach ($group_members as $member){
                    if ($member->group_id == $group_id){
                        $member -> delete();

                        $all_members = NjangiGroupMember::where('group_id','=',$group_id)->get();

                        return response()->json([
                            'status'=>true,
                            'message'=>"Member Removed Successfully",
                            'all members'=>$all_members,
                            'removed by' =>auth()->user()
                        ]);
                    }
                }
            }
        }
        return response([
            'status'=>false,
            'message'=>'You do not have access to remove member',
            'user'=>auth()->user()
        ]);
    }


    public function njangi_group_all_loan($group_id){

    }


}
