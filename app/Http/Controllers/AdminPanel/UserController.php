<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\ResetPass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;

class UserController extends Controller
{
    public function index(){
        return view('AdminPanel.Profiles.profile');
    }

    public function update(Request $request){
        $user = User::find($request->id);

        $profileImage = $request->file('image');

        if ($profileImage) {
            if ($user->image == null) {

                $imageName = date('mdYHis') . uniqid() . $profileImage->getClientOriginalName();
                $directory = 'assets/image/userprofile/';
                $imageUrl = $directory . $imageName;
                Image::make($profileImage)->resize(400, 400)->save($imageUrl);


                $user->image = $imageUrl;

            } else {
                unlink($user->image);
                $imageName = date('mdYHis') . uniqid() . $profileImage->getClientOriginalName();
                $directory = 'assets/image/userprofile/';
                $imageUrl = $directory . $imageName;
                Image::make($profileImage)->resize(512, 512)->save($imageUrl);


                $user->image = $imageUrl;

            }
        }


        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_no = $request->mobile_no;
        $user->save();

        return back()->with('message','Profile Updated');
    }

    public function  password_settings(){
        return view('AdminPanel.Profiles.password_settings');
    }

    public function admin_password_reset_post(Request $request){
        $request->validate( [
            'old_password' => ['required', new ResetPass()],
            'password'=> 'required|min:4|confirmed'
        ]);

                auth()->user()->update([
                    'password' => \bcrypt($request->password),
                ]);

                return back()->with('message','password updated');

    }

    public function user_list(){

        $users = User::orderBy('id','desc')->get();
        return view('AdminPanel.Users.users',[
            'users'=>$users
        ]);
    }

    public function banned($id){
        $user = User::find($id);
        $user->is_ban = 1;
        $user->save();
        return back()->with('message','User Banned successfully');
    }
    public function unbanned($id){
        $user = User::find($id);
        $user->is_ban = 0;
        $user->save();
        return back()->with('message','User Unbanned successfully');

    }

}
