<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function getAllUsersListApi(){
        $users = User::where('role','=','user')->get();

        return response()->json([
            'status'=>true,
            'data'=>$users
        ]);
    }
}
