<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InvestmentGroup;
use App\Models\InvestmentGroupMember;
use App\Models\InvestmentLoan;
use Illuminate\Http\Request;

class InvestmentLoanController extends Controller
{
    public function request_for_invest_loan($group_id,Request $request){
        $request->validate([
            'loan_amount'=>'required'
        ]);
        $user = auth()->user()->id;

        $group = InvestmentGroup::find($group_id);

        $members = InvestmentGroupMember::where('group_id','=',$group_id)->get();

        foreach ($members as $member){
            if ($member->members_id == $user){

                $loan = new InvestmentLoan();
                $loan->group_id = $group_id;
                $loan->member_id = $user;
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

    public function invest_group_all_loan($group_id){
        $group = InvestmentGroup::with('investCreator')->find($group_id);

        $admin =InvestmentGroupMember::where('group_id','=',$group_id)->where('role','=','admin')->where('members_id','=',auth()->user()->id)->get();

//        return response(['admin'=>$admin]);

        if ($admin->isNotEmpty()){
            $all_loan = InvestmentLoan::all();
            $admins =InvestmentGroupMember::with('invest_members','investmentGroup')->where('group_id','=',$group_id)->where('role','=','admin')->get();

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


    public function invest_group_loan_status_change($loan_id, Request $request){

        $loan_details = InvestmentLoan::find($loan_id);


        $request->validate([
            'loan_status'=>'required'
        ]);
//        return response(['loan'=>$request->loan_status]);
        $group_details = InvestmentGroup::find($loan_details->group_id);
        $admins = InvestmentGroupMember::where('group_id','=',$group_details->id)->where('role','=','admin')->get();
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
