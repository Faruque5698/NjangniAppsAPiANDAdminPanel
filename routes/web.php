<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPanel\DashboardController;
use App\Http\Controllers\AdminPanel\GeneralSettingController;
use App\Http\Controllers\AdminPanel\AppDetailsController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\AdminPanel\NjangiGorupController;
use App\Http\Controllers\AdminPanel\InvestmentGroupController;
use App\Http\Controllers\AdminPanel\SocialIconController;
use App\Http\Controllers\AdminPanel\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('loginError',[ErrorController::class,'loginError']);

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard')->middleware(['auth'])->middleware('checkRole')->middleware('isBan');

Route::get('/', function () {
    return redirect('/dashboard');
})->middleware(['auth'])->middleware('checkRole');

Route::group(['middleware'=>'auth','middleware'=>'checkRole','middleware'=>'isBan'],function (){
    Route::get('general_settings',[GeneralSettingController::class,'index'])->name('general_settings');
;
    Route::get('setting_active/{id}',[GeneralSettingController::class,'setting_active'])->name('setting_active');
    Route::get('setting_inactive/{id}',[GeneralSettingController::class,'setting_inactive'])->name('setting_inactive');

    Route::post('update_setting',[GeneralSettingController::class,'update'])->name('update_settings');
    Route::post('add_settings',[GeneralSettingController::class,'add_settings'])->name('add_settings');


    Route::get('About',[AppDetailsController::class,'about'])->name('about');
    Route::get('about_inactive/{id}',[AppDetailsController::class,'about_inactive'])->name('about_inactive');
    Route::get('about_active/{id}',[AppDetailsController::class,'about_active'])->name('about_active');
//    Route::get('fetch_about',[AppDetailsController::class,'fetch_about'])->name('fetch_about');
//    Route::get('delete_about/{id}',[AppDetailsController::class,'delete_about'])->name('delete_about');
//    Route::post('SaveAbout',[AppDetailsController::class,'SaveAbout'])->name('SaveAbout');

    Route::post('add_about',[AppDetailsController::class,'add_about'])->name('add_about');
    Route::post('update_about',[AppDetailsController::class,'update'])->name('update_about');

    Route::get('social',[SocialIconController::class,'social'])->name('social');
    Route::post('SaveIcon',[SocialIconController::class,'SaveIcon'])->name('SaveIcon');
    Route::get('fetch_socialIcon',[SocialIconController::class,'fetch_socialIcon'])->name('fetch_socialIcon');
    Route::get('editSocialIcon/{id}',[SocialIconController::class,'editSocialIcon'])->name('editSocialIcon');
    Route::get('delete_icon/{id}',[SocialIconController::class,'delete_icon'])->name('delete_icon');
    Route::post('UpdateSaveIcon',[SocialIconController::class,'updateSaveIcon'])->name('UpdateSaveIcon');


    Route::get('njangi_groups',[NjangiGorupController::class,'index'])->name('njangi_groups');
    Route::get('delete_njangi_group/{id}',[NjangiGorupController::class,'destroy'])->name('delete_njangi_group');
    Route::get('njangi_group_members_list/{id}',[NjangiGorupController::class,'njangi_group_members_list'])->name('njangi_group_members_list');

    Route::get('member_details/{id}',[NjangiGorupController::class,'member_details'])->name('member_details');
    Route::get('member_delete/{id}',[NjangiGorupController::class,'member_delete'])->name('member_delete');


    Route::get('investment_group',[InvestmentGroupController::class,'index'])->name('investment_group');
    Route::get('invest_group_members_list/{id}',[InvestmentGroupController::class,'invest_group_members_list'])->name('invest_group_members_list');

    Route::get('invest_member_details/{id}',[InvestmentGroupController::class,'member_details'])->name('invest_member_details');
//    Route::get('invest_member_delete/{id}',[NjangiGorupController::class,'member_details'])->name('invest_member_details');




Route::get('profiles',[UserController::class,'index'])->name('profiles');
Route::post('profile_update',[UserController::class,'update'])->name('profile_update');
Route::get('password_settings',[UserController::class,'password_settings'])->name('password_settings');
Route::post('admin_password_reset_post',[UserController::class,'admin_password_reset_post'])->name('admin_password_reset_post');
    Route::get('users',[UserController::class,'user_list'])->name('users');
    Route::get('banned/{id}',[UserController::class,'banned'])->name('banned');
    Route::get('unbanned/{id}',[UserController::class,'unbanned'])->name('unbanned');

});

require __DIR__.'/auth.php';
