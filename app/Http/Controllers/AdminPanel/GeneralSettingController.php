<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use Illuminate\Http\Request;
use Image;

class GeneralSettingController extends Controller
{
    public function index(){
        $settings = GeneralSettings::find(1);
        return view('AdminPanel.General_settings.General_settings',[
            'settings' => $settings
        ]);
    }
    public function add_settings(){
        return view('Adminpanel.General_settings.add_settings');
    }

//    public function add_settings (Request $request){
//        $request->validate([
//            'name'=>'required',
//            'logo'=>'required|image'
//        ]);
//
//
//        $setting = new GeneralSettings();
//        $fabImage = $request->file('fav_icon');
//
//        $settingsImage = $request->file('logo');
//        $imageName =date('mdYHis') . uniqid(). $settingsImage->getClientOriginalName();
//        $directory = 'assets/image/settings/';
//        $imageUrl = $directory.$imageName;
//        Image::make($settingsImage)->resize(512,512)->save($imageUrl);
//
//        $imageName = date('mdYHis') . uniqid() . $fabImage->getClientOriginalName();
//        $directory = 'assets/image/settings/fav_icon/';
//        $imageUrl1 = $directory . $imageName;
//        Image::make($fabImage)->resize(80, 80)->save($imageUrl1);
////        $settingsImage -> move($directory,$imageName);
//
//        $setting->name = $request->name;
//        $setting->logo = $imageUrl;
//        $setting->fab_icon = $imageUrl1;
//        $setting->save();
//
//        return redirect('general_settings')->with('message','New General Settings successfully Added');
//
//
//    }
    public function setting_active($id){
        $setting = GeneralSettings::find($id);
        $setting->status = 'active';
        $setting->save();
        return back()->with('message','Activate Successfully');
    }
    public function setting_inactive($id){
        $setting = GeneralSettings::find($id);
        $setting->status = 'inactive';
        $setting->save();
        return back()->with('message','Inactivate Successfully');
    }
    public function setting_edit($id){
        $setting = GeneralSettings::find($id);

        return view('Adminpanel.General_settings.edit_setting',[
            'setting'=>$setting
        ]);
    }



    public function update(Request $request){

        $request->validate([
            'name'=>'required',
            'footer_text'=>'required'
        ]);

        $setting = GeneralSettings::find(1);
        if ($setting!=null){
            $settingsImage = $request->file('logo');
            $fabImage = $request->file('fav_icon');
            if($settingsImage || $fabImage) {
                if ($settingsImage) {
                    if ($setting->logo == null) {

                        $imageName = date('mdYHis') . uniqid() . $settingsImage->getClientOriginalName();
                        $directory = 'assets/image/settings/';
                        $imageUrl = $directory . $imageName;
                        Image::make($settingsImage)->resize(512, 512)->save($imageUrl);


                        $setting->logo = $imageUrl;

                    } else {
                        unlink($setting->logo);
                        $imageName = date('mdYHis') . uniqid() . $settingsImage->getClientOriginalName();
                        $directory = 'assets/image/settings/';
                        $imageUrl = $directory . $imageName;
                        Image::make($settingsImage)->resize(512, 512)->save($imageUrl);


                        $setting->logo = $imageUrl;

                    }
                }
                if ($fabImage) {
                    if ($setting->fab_icon == null) {

                        $imageName = date('mdYHis') . uniqid() . $fabImage->getClientOriginalName();
                        $directory = 'image/settings/fav_icon/';
                        $imageUrl = $directory . $imageName;
                        Image::make($fabImage)->resize(80, 80)->save($imageUrl);


                        $setting->fab_icon = $imageUrl;

                    } else {
                        unlink($setting->fab_icon);
                        $imageName = date('mdYHis') . uniqid() . $fabImage->getClientOriginalName();
                        $directory = 'image/settings/fav_icon';
                        $imageUrl = $directory . $imageName;
                        Image::make($fabImage)->resize(80, 80)->save($imageUrl);


                        $setting->fab_icon = $imageUrl;

                    }
                }


                $setting->name = $request->name;
                $setting->footer_text = $request->footer_text;
                $setting->save();

                return redirect('general_settings')->with('message','General Settings Updated');

            }else{
                $setting->name = $request->name;
                $setting->footer_text = $request->footer_text;
                $setting->save();


                return redirect('general_settings')->with('message','General Settings Updated');


            }
        }else{

            $setting = new GeneralSettings();
            $fabImage = $request->file('fav_icon');

            $settingsImage = $request->file('logo');
            $imageName =date('mdYHis') . uniqid(). $settingsImage->getClientOriginalName();
            $directory = 'assets/image/settings/';
            $imageUrl = $directory.$imageName;
            Image::make($settingsImage)->resize(512,512)->save($imageUrl);

            $imageName = date('mdYHis') . uniqid() . $fabImage->getClientOriginalName();
            $directory = 'assets/image/settings/fav_icon/';
            $imageUrl1 = $directory . $imageName;
            Image::make($fabImage)->resize(80, 80)->save($imageUrl1);
//        $settingsImage -> move($directory,$imageName);

            $setting->id = 1;
            $setting->name = $request->name;
            $setting->footer_text = $request->footer_text;
            $setting->logo = $imageUrl;
            $setting->fab_icon = $imageUrl1;
            $setting->save();

            return redirect('general_settings')->with('message','New General Settings successfully Added');
        }




    }

//    public function delete_settings($id){
//        $setting = GeneralSettings::find($id);
//        unlink($setting->logo);
//        $setting->delete();
//
//        return back()->with('message','Data Deleted Successfully');
//    }
}
