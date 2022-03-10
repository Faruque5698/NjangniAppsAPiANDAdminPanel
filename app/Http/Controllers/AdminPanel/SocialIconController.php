<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\SocialIcon;
use Illuminate\Http\Request;

class SocialIconController extends Controller
{
    public function social(){
//        $socialIcon =SocialIcon::all();
//        return $socialIcon;
        return view('AdminPanel.AppDetails.Social',[
//            'socialIcon'=>$socialIcon
        ]);
    }

    public function SaveIcon(Request $request){
        $icon  = new SocialIcon();

        $icon->name=$request->name;
        $icon->url=$request->url;
        $icon->icon=$request->icon;
        $icon->save();

//        echo "hello";
//        return response([
//            'hello'=>'hello'
//        ]);

        return response()->json([
            'status'=>200,
            'message' =>'successfully data save'
        ]);

    }

    public function fetch_socialIcon(){
        $icon = SocialIcon::all();
        return response()->json([

            'icon'=>$icon
        ]);
    }

    public function editSocialIcon($id){
        $icon = SocialIcon::find($id);
        if ($icon){
            return response()->json([
                'status'=>200,
                'icon'=>$icon
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>"data not found"
            ]);
        }
    }

    public function updateSaveIcon(Request $request){
        $icon = SocialIcon::find($request->id);
        $icon->name=$request->name;
        $icon->url=$request->url;
        $icon->icon=$request->icon;
        $icon->save();

        return response()->json([
            'status'=>200,
            'message' =>'successfully data Updated'
        ]);

    }

    public function delete_icon($id){
        $icon = SocialIcon::find($id);
        $icon->delete();
        return response()->json([
            'message'=>'Data deleted Success fully'
        ]);
    }
}
