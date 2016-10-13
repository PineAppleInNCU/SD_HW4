<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Response;
use App\User;
use App\Guest;
use App\Reply;
use App\Messenger;
use Auth;
use DB;


class MessengerController extends Controller
{
    //
    public function index(){

	$messages=DB::table('messengers')->orderBy('updated_at','ASC')->get();

	

	return view('messenger',array('messages'=>$messages));
    }
    //將資料裝入資料庫
    public function test_polling(Request $request){

        if(Auth::check()){
		$username=Auth::user()->name;
        }
	else{
		$username="訪客";
	}

        $messenger=new Messenger;
	$messenger->username=$username;
	$messenger->message=$request->message;
	$messenger->save();

	
  	return response()->json($request);
    }
    public function get_name(){
	if(Auth::check()){
		$username=array(
			"username"=>Auth::user()->name,
			"messages"=>Messenger::all()
		);
		echo $username;
	}
	else{
		$username=array(
			"username"=>"訪客",
			"messages"=>Messenger::all()
		//	"messages"=>DB::select('select * from messengers where id>?',[100])  另外一種查找資料的方法
		);
	}
	$a='a';
	return response()->json($username);
    }
    public function poll(Request $request){

        //check the database to decide whether the message board need to be update	
	for($i=0;$i<180;$i++){
		$old_messages=$request->messages;
		$new_messages=DB::table('messengers')->orderBy('updated_at','ASC')->get();
	
		$new_message_number=count($new_messages);
		$old_message_number=count($old_messages);		


		if($new_message_number===$old_message_number){
			
		}
		else{
			$messages=array(
				"username"=>$request->username,
				"messages"=>$new_messages, 
				"new_messages"=>DB::select('select * from messengers where id>? order by updated_at ASC',[$old_message_number])  //用來更新用的資料(半邊資料)
				//是否將傳送半邊資料，改為傳送資料列數，會更有效呢?
			);
			return response()->json($messages);
		}
		usleep(1000000);
	}

	//usleep(5000000);   //  x/1000000 = 1 seconds
	$messages=array(
		"username"=>$request->username,
		"messages"=>$new_messages
	);
	return response()->json($messages);

    }
}
