<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use Auth;
use App\User;
use App\Guest;
use App\Reply;
use DB;


class WelcomeController extends Controller
{
    //
    public function index(){
	//$messages=Guest::all();
	//$replys=Reply::all();

	$messages=DB::table('guest')->orderBy('guestTime','DESC')->get();

	$replys=DB::table('reply')->orderBy('replyTime','DESC')->get();

	return view('welcome',array('messages'=>$messages,'replys'=>$replys));
    }
    public function make_message(Request $request){
	Guest::create([
		'username' => Auth::user()->name,
	 	'content'  => $request->guestContent,
		'guestTime'=> date("Y:m:d H:i:s",time()+28800)
		]); 		


	//$messages=Guest::all();
	//$replys=Reply::all();
	$messages=DB::table('guest')->orderBy('guestTime','DESC')->get();

	$replys=DB::table('reply')->orderBy('replyTime','DESC')->get();

	return redirect('/');
	//return view('welcome',array('messages'=>$messages,'replys'=>$replys));
	
	//return response()->json($request);

    }
    public function test_route_2(Request $request){
	echo $request->username;
		
	//return response()->json($request);
    }
    public function message_delete(Request $request){//刪除留言
        $message_object = Guest::find($request->messageId);

        $message_object->delete();

        return redirect('/');
    }
    public function message_delete_error(Request $request){
	echo "<script>alert('留言者才能刪除該留言');</script>";
//	return redirect('/');
    }
    public function message_fix(Request $request){
	
	

	return view('reply',array('username'=>$request->username,'content'=>$request->content,'status'=>$request->status,'messageId'=>$request->messageId));
    }
    public function reply_fix(Request $request){
	
	

	return view('reply',array('username'=>$request->username,'content'=>$request->content,'status'=>$request->status,'replyId'=>$request->replyId));
    }
       



}
