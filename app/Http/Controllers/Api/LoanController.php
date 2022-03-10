<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\NjangiGorup;
use App\Models\NjangiGroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function request_for_loan($group_id,Request $request){
        $request->validate([
            'loan_amount'=>'required'
        ]);
        $user = auth()->user()->id;

        $group = NjangiGorup::find($group_id);

        $members = NjangiGroupMember::where('group_id','=',$group_id)->get();

        foreach ($members as $member){
            if ($member->members_id == $user){

                $loan = new Loan();
                $loan->group_id = $group_id;
                $loan->members_id = $user;
                $loan->loan_amount = $request->loan_amount;
                $loan -> save();

                return response()->json([
                    'status'=>true,
                    'message'=>'Loan Request Send',
                    'data'=>$loan
                ]);

            }
        }

        return response()->json([
            'status'=>false,
            'message'=>'You are not in this group'
        ]);

    }

    public function njangi_group_all_loan($group_id){
        $group = NjangiGorup::with('njangiCreator')->find($group_id);

        $admin =NjangiGroupMember::where('group_id','=',$group_id)->where('role','=','admin')->where('members_id','=',auth()->user()->id)->get();

//        return response(['admin'=>$admin]);

        if ($admin->isNotEmpty()){
            $all_loan = Loan::all();
            $admins =NjangiGroupMember::with('njangiGroup','members')->where('group_id','=',$group_id)->where('role','=','admin')->get();

//            $group_creator_details = NjangiGorup::with('njangiCreator')->find($group_id);

            return response()->json([
                'group_details' => $group,
                'admins'=>$admins,
                'all_Loans'=>$all_loan
            ]);
        }else{
            return response(['admin'=>'Not admin']);
        }


    }


    public function njangi_group_loan_status_change($loan_id, Request $request){

        $loan_details = Loan::find($loan_id);


        $request->validate([
            'loan_status'=>'required'
        ]);
//        return response(['loan'=>$request->loan_status]);
        $group_details = NjangiGorup::find($loan_details->group_id);
        $admins = NjangiGroupMember::where('group_id','=',$group_details->id)->where('role','=','admin')->get();
        $user_id =auth()->user()->id;
        if ($admins->isEmpty()){
            return response()->json([
                'status'=>false,
                'user_details'=>auth()->user(),
                'message'=>'You are not Admin'
            ]);
        }else {
            foreach ($admins as $admin) {
                if ($admin->members_id == $user_id) {


                    $loan_details->loan_status = $request->loan_status;
                    $loan_details->save();

                    return response()->json([
                        'status' => true,
                        'admin' => $admin,
                        'loan_details' => $loan_details,
                        'group_details' => $group_details,
                        'all_admins' => $admins,
                        'This_admin_details' => auth()->user()
                    ]);
                }
            }
        }

    }







    public function ashad(){
        $data =DB::table('ashad sarkar')->get();
        return response([
            'data'=>$data
        ]);
    }
}
