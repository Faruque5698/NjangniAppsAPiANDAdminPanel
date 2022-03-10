<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\InvestmentGroup;
use App\Models\InvestmentLoan;
use App\Models\Loan;
use App\Models\NjangiGorup;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $njangiGroup = NjangiGorup::all();
        $njangiGroupsCount = count($njangiGroup);

        $njangiGroups = NjangiGorup::with('njangiCreator')->orderBy('id','desc')->get();

        $total_loan_request_ammount = Loan::all()->sum('loan_amount');
        $total_loan_approved_ammount = Loan::where('loan_status','=','approved')->sum('loan_amount');

        $loanCount = count(Loan::all());


        $investmentGroups = InvestmentGroup::with('investCreator')->orderBy('id','desc')->get();
        $investmentGroupCount = count($investmentGroups);

        $total_loan_request_invest_ammount = InvestmentLoan::all()->sum('loan_amount');
        $total_loan_approved_invest_ammount = InvestmentLoan::where('loan_status','=','approved')->sum('loan_amount');

        $investLoanCount = count(InvestmentLoan::all());


        $totalUser = count(User::all()) ;


//        return $loans;


        return view('AdminPanel.Dashboard.Dashboard',[
            'njangiGroups'=>$njangiGroups,
            'njangiGroupsCount'=>$njangiGroupsCount,
            'total_loan_request_ammount'=>$total_loan_request_ammount,
            'total_loan_approved_ammount'=>$total_loan_approved_ammount,
            'loanCount'=>$loanCount,
            'investmentGroups'=>$investmentGroups,
            'investmentGroupCount'=>$investmentGroupCount,
            'total_loan_request_invest_ammount'=>$total_loan_request_invest_ammount,
            'total_loan_approved_invest_ammount'=>$total_loan_approved_invest_ammount,
            'investLoanCount'=>$investLoanCount,
            'totalUser'=>$totalUser
        ]);
    }
}
