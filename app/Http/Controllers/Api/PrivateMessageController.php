<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PrivateMessageController extends Controller
{
    public function create($id){
        $receiver = User::find($id);

        $sender_id = auth()->user()->id;

        $table_name = 'private_message'.$sender_id.$id;
        $table_name2 = 'private_message'.$id.$sender_id;

        if (Schema::hasTable($table_name) || Schema::hasTable($table_name2)){
            if (Schema::hasTable($table_name)){

                $data = DB::table($table_name)->orderBy('created_at','desc')->get();

                return response([
                   'status'=>true,
                    'table'=>$table_name,
                    'sender'=>auth()->user(),
                    'messages'=>$data,
                    'receiver'=>$receiver
                ]);

            }elseif (Schema::hasTable($table_name2)){

                $data = DB::table($table_name2)->orderBy('created_at','desc')->get();

                return response([
                    'status'=>true,
                    'table'=>$table_name2,
                    'sender'=>auth()->user(),
                    'messages'=>$data,
                    'receiver'=>$receiver
                ]);

            }else{
                return response(['status'=>false]);
            }
        }else{
            Schema::create($table_name,function ($table){
                $table->increments('id');
                $table->unsignedBigInteger('sender_id');
                $table->string('sender_name');
                $table->text('message');
                $table->timestamps();
                $table->foreign('sender_id')->references('id')->on('users')->onDelete('CASCADE');
            });

            return response()->json([
                'status'=>true,
                'sender'=>auth()->user(),
                'receiver'=>$receiver
            ]);
        }

    }


    public function send(Request $request){
        $request->validate([
            'id'=>'required',
            'message'=>'required',
        ]);
        $receiver = User::find($request->id);
        $sender_id = auth()->user()->id;
        $sender = auth()->user();
        $table_name = 'private_message'.$sender_id.$request->id;
        $table_name2 = 'private_message'.$request->id.$sender_id;

        if (Schema::hasTable($table_name)){

            DB::table($table_name)->insert([
                'sender_id'=>$sender_id,
                'sender_name'=>auth()->user()->name,
                'message'=>$request->message,
                'created_at'=>new \DateTime(),
                'updated_at'=>new \DateTime(),
            ]);

            $all_message=DB::table($table_name)->orderBy('created_at','desc')->get();
            $last_message_by_sender = DB::table($table_name)->where('sender_id','=',$sender_id)->orderBy('created_at','desc')->first();

            return response()->json([
                'status'=>true,
                'sender'=>$sender,
                'receiver'=>$receiver,
                'last_message_by_sender' => $last_message_by_sender,
                'all_message' => $all_message,
                'created_at'=>new \DateTime(),
                'updated_at'=>new \DateTime(),
            ]);
        }elseif (Schema::hasTable($table_name2)){
            DB::table($table_name2)->insert([
                'sender_id'=>$sender_id,
                'sender_name'=>auth()->user()->name,
                'message'=>$request->message,
                'created_at'=>new \DateTime(),
                'updated_at'=>new \DateTime(),
            ]);
            $all_message=DB::table($table_name2)->orderBy('created_at','desc')->get();
            $last_message_by_sender = DB::table($table_name2)->where('sender_id','=',$sender_id)->orderBy('created_at','desc')->first();

            return response()->json([
                'status'=>true,
                'sender'=>$sender,
                'receiver'=>$receiver,
                'last_message_by_sender' => $last_message_by_sender,
                'all_message' => $all_message
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'Table not found'
            ]);
        }

    }
}
