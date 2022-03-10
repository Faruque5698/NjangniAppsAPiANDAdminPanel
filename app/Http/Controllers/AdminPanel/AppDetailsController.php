<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\SocialIcon;
use Illuminate\Http\Request;

class AppDetailsController extends Controller
{
    public function about(){
        $about = About::find(1);
        return view('AdminPanel.AppDetails.appDetails',['about'=>$about]);
    }

    public function update(Request $request){
        $about = About::find(1);

        if ($about!=null){
            $about->email = $request->email;
            $about->description = $request->description;
            $about->save();
            return back()->with('message','About Updated Successfully');
        }else{
            $about  = new About();
            $about->id = 1;
            $about->email = $request->email;
            $about->description = $request->description;
            $about->save();
            return back()->with('message','About Updated Successfully');
        }






    }

    public function add_about(Request $request){
//        $request->validate([
//            'email'=>'required|email|email:abouts',
////            'description'=>'required'
//        ]);

        $about = new About();
        $about->id = 1;
        $about->email = $request->email;
        $about->description = $request->description;
        $about->save();

        return back()->with('message','New App Details About Added');
    }

//    public function fetch_about(){
//        $abouts = About::all();
//        return response()->json([
//           'status'=>200,
//            'abouts'=>$abouts
//        ]);
//    }
    public function about_inactive($id){
        $about = About::find($id);
        $about->status = 'inactive';
        $about->save();

        return back()->with('message','About Inactive Successfully');
    }
    public function about_active($id){
        $about = About::find($id);
        $about->status = 'active';
        $about->save();

        return back()->with('message','About Active Successfully');
    }





}
