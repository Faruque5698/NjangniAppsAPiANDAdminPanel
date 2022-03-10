<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\NewPasswordController;
use App\Http\Controllers\Api\NjangiGorupController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\Api\LoanController;
use App\Http\Controllers\Api\InvestmentGroupController;
use App\Http\Controllers\Api\NjangiGroupMessageController;
use App\Http\Controllers\Api\PrivateMessageController;
use App\Http\Controllers\Api\InvestmentGroupMessageController;
use App\Http\Controllers\Api\InvestmentLoanController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register',[CustomerController::class,'register']);
Route::post('email_mobile_register',[CustomerController::class,'email_mobile_register']);
Route::post('login',[CustomerController::class,'login'])->middleware('isBan');
Route::post('email_mobile_login',[CustomerController::class,'email_mobile_login'])->middleware('isBan');


Route::group(['middleware'=>['auth:api'],'middleware'=>'isBan'], function (){
    Route::get('profile',[CustomerController::class,'profile']);
    Route::get('edit_profile',[CustomerController::class,'edit_profile']);


//    Njangi Group Api

    Route::post('create_njangi_group',[NjangiGorupController::class,'create'])->name('create_njangi_group');

    Route::get('njangi_group_list',[NjangiGorupController::class,'njangi_group_list'])->name('njangi_group_list');
    Route::get('all_njangi_group_list',[NjangiGorupController::class,'all_njangi_group_list'])->name('all_njangi_group_list');
    Route::get('i_am_in_njangi_group_list',[NjangiGorupController::class,'i_am_in_njangi_group_list'])->name('i_am_in_njangi_group_list');


    Route::get('delete_njangi_group/{id}',[NjangiGorupController::class,'destroy'])->name('delete_njangi_group');
    Route::get('add_njangi_group_members/{group_id}',[NjangiGorupController::class,'add_njangi_group_members'])->name('add_njangi_group_members');
    Route::get('njangi_group_members_list/{group_id}',[NjangiGorupController::class,'njangi_group_members_list'])->name('njangi_group_members_list');

    Route::get('member_details/{id}',[NjangiGorupController::class,'member_details'])->name('member_details');
    Route::get('member_remove/{member_id}/{group_id}',[NjangiGorupController::class,'member_remove'])->name('member_remove');


//    Njangi Group Message
    Route::post('njangi_group_message',[NjangiGroupMessageController::class,'sendMessage']);/*Send group id with request method*/
    Route::post('investment_group_message',[InvestmentGroupMessageController::class,'sendMessage']);/*Send group id with request method*/
//    Route::get('delete_ njangi_group_message',[NjangiGroupMessageController::class,'sendMessage']);
    /*Send group id with request method*/

    Route::get('private_message/{id}',[PrivateMessageController::class,'create']);
    Route::post('send_private_message',[PrivateMessageController::class,'send']);/*Send receiver id*/

//    Loan Api

    Route::get('request_for_loan/{group_id}',[LoanController::class,'request_for_loan']);
    Route::get('njangi_group_all_loan/{group_id}',[LoanController::class,'njangi_group_all_loan']);
    Route::get('njangi_group_loan_status_change/{loan_id}',[LoanController::class,'njangi_group_loan_status_change']);

//    Invest Loan Api
    Route::get('request_for_invest_loan/{group_id}',[InvestmentLoanController::class,'request_for_invest_loan']);
    Route::get('invest_group_all_loan/{group_id}',[InvestmentLoanController::class,'invest_group_all_loan']);
    Route::get('invest_group_loan_status_change/{loan_id}',[InvestmentLoanController::class,'invest_group_all_loan']);




//    Investment Group Api

    Route::post('create_investment_group',[InvestmentGroupController::class,'create_investment_group']);

    Route::get('investment_group_list',[InvestmentGroupController::class,'investment_group_list']);
    Route::get('all_investment_group_list',[InvestmentGroupController::class,'all_investment_group_list']);
    Route::get('i_am_in_investment_group_list',[NjangiGorupController::class,'i_am_in_investment_group_list']);


    Route::get('delete_investment_group/{id}',[InvestmentGroupController::class,'destroy']);

    Route::get('add_investment_group_members/{group_id}',[InvestmentGroupController::class,'add_investment_group_members']);
    Route::get('investment_group_members_list/{group_id}',[InvestmentGroupController::class,'investment_group_members_list']);
    Route::get('investment_member_details/{id}',[InvestmentGroupController::class,'investment_member_details']);
    Route::get('investment_member_remove/{member_id}/{group_id}',[InvestmentGroupController::class,'investment_member_remove']);





    Route::post('logout',[CustomerController::class,'logout']);

    Route::get('all_users',[FrontEndController::class,'getAllUsersListApi']);





});

Route::post('forgot-password',[NewPasswordController::class,'forgotPassword'])->name('forgotPassword');
Route::post('reset-password',[NewPasswordController::class,'resetPassword'])->name('resetPassword');


Route::get('ashad',[LoanController::class,'ashad']);

