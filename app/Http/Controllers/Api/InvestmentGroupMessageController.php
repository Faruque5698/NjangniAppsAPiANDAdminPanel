<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InvestmentGroup;
use App\Models\InvestmentGroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestmentGroupMessageController extends Controller
{
    public function sendMessage(Request $request){
        $sender_id = auth()->user()->id;
        $group_id = $request->group_id;
        $group = InvestmentGroup::find($group_id);

        if ($group){
            $group_name = $group->group_name."_investment";
            $member = InvestmentGroupMember::where('group_id','=',$group_id)->where('members_id','=',$sender_id)->get();

            if ($member){
                DB::table($group_name)->insert([
                    'group_id'=>$group_id,
                    'group_name'=>$group_name,
                    'message'=>$request->message,
                    'sender_id'=>$sender_id,
                    'created_at'=>new \DateTime(),
                    'updated_at'=>new \DateTime(),
                ]);
                $message = DB::table($group_name)->where('sender_id','=',$sender_id)->orderBy('created_at', 'desc')->first();

                $allMessage = DB::table($group_name)->orderBy('id','DESC')->get();

                return response()->json([
                    'status'=>true,
                    'group_details'=>$group,
                    'sender_details'=>auth()->user(),
                    'last_message_by_sender'=>$message,
                    'all_message' => $allMessage,
                ]);
            }else{
                return  response()->json([
                    'status'=>false,
                    'message'=>'you are not in this Group'
                ]);
            }
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'No group Exists'
            ]);
        }



    }
}
