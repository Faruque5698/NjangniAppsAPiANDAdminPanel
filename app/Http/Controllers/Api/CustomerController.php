<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function register(Request $request){
//        validation
        $request->validate([
           'name' =>'required',
            'email'=>'required|email|unique:users',
            'password' => 'required|min:5|max:12|confirmed',
        ]);
//        create

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
//        $user->phone_no = $request->phone_no;
        $user->save();

        $accessToken = $user->createToken('authToken')->accessToken;

//        save data response

        return response()->json([
            'status'=>1,
            "message"=>"Customer Created successfully",
            "user"=>$user,
            "accessToken"=>$accessToken
        ]);

    }

    public function email_mobile_register(Request $request){
        $mobile = $request->mobile_no;
        $gmail = $request->email;



        $user = new User();

        if ($mobile!=null){
            $request->validate([
               'mobile_no'=>'unique:users'
            ]);
            $user -> mobile_no = $request->mobile_no;
            $user->save();

            $accessToken = $user->createToken('authToken')->accessToken;
            return response()->json([
                'status'=>1,
                "message"=>"Customer Created successfully",
                "user"=>$user,
                "accessToken"=>$accessToken
            ]);
        }else if($gmail!=null){
            $request->validate([
                'email'=>'unique:users'
            ]);
            $user -> email = $request->email;
            $user->save();

            $accessToken = $user->createToken('authToken')->accessToken;
            return response()->json([
                'status'=>1,
                "message"=>"Customer Created successfully",
                "user"=>$user,
                "accessToken"=>$accessToken
            ]);
        }else{
            return response()->json([
                'status'=>0,
                'message'=>'Please Fill up Email or phone number field'
            ]);
        }
    }

    public function login(Request $request){

        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }



        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response()->json([
            "status" => true,
            "message" => "Customer Logged Successfully",
            "user"=>auth()->user(),
            "token" => $accessToken
        ]);
//        return response(['user' => auth()->user(), 'access_token' => $accessToken]);

    }

    public function email_mobile_login(Request $request){
        $mobile = $request->mobile_no;
        $gmail = $request->email;

        if ($gmail != null){
             $request->validate([
                'email' => 'email|required',


            ]);
            $loginData = User::where('email','=',$gmail)->first();
            if ($loginData){
                $accessToken = $loginData->createToken('authToken')->accessToken;
                return response()->json([
                    "status" => true,
                    "message" => "Customer Logged Successfully",
                    "user"=>auth()->user(),
                    "token" => $accessToken
                ]);
            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'invalid email'
                ]);
            }
        }elseif ($mobile!=null){
            $request->validate([
                'mobile_no' => 'required',


            ]);
            $loginData = User::where('mobile_no','=',$mobile)->first();
            if ($loginData){
                $accessToken = $loginData->createToken('authToken')->accessToken;
                return response()->json([
                    "status" => true,
                    "message" => "Customer Logged Successfully",
                    "user"=>$loginData,
                    "token" => $accessToken
                ]);
            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'invalid mobile number'
                ]);
            }
        }else{
            return response()->json([
                'status'=>0,
                'message'=>'Please Fill up Email or phone number field'
            ]);
        }
    }

    public function profile(){
        $user_data = auth()->user();
        return response()->json([
           'status'=>true,
           'message'=>'User Data',
            'data'=>$user_data
        ]);
    }


    public function edit_profile(Request $request){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $profile_image = $request->file('image');
        if ($profile_image){
            if($user->image){
                unlink($user->image);
            }
            $imageName =date('mdYHis') . uniqid(). $profile_image->getClientOriginalName();
            $directory = 'assets/image/userprofile/';
            $imageUrl = $directory.$imageName;
            Image::make($profile_image)->resize(512,512)->save($imageUrl);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile_no = $request->mobile_no;
            $user->image = $request->$imageUrl;
            $user->save();

            return response()->json([
                'status'=>true,
                'message'=>"Profile Updated",
                'Updated data'=>$user,

            ]);

        }else{
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile_no = $request->mobile_no;
//            $user->image = $request->$imageUrl;
            $user->save();

            return response()->json([
                'status'=>true,
                'message'=>"Profile Updated",
                'Updated data'=>$user,

            ]);
        }
    }


    public function logout(Request $request){

//        get Token value
        $token = $request->user()->token();

//        revoke this token
        $token->revoke();

        return response()->json([
           'status'=>true,
           'message'=>"User Logged Out Successfully"
        ]);

    }
}
