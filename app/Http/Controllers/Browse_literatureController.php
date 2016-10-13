<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use Auth;
use App\User;
use App\Guest;
use App\Reply;
use App\Main_discussion;
use App\Sub_discussion;
use App\Reply_sub_discussion;
use DB;



class Browse_literatureController extends Controller
{
	public function index($academy){
		$discussions=DB::table('main_discussion')->orderBy('updated_at','DESC')->get();

		return view('browse_all_message_literature',array('discussions'=>$discussions,'academy'=>$academy));
	
	}
	public function new_a_message(Request $request){//進入新增討論主題的頁面
		return view('new_message',array('academy'=>$request->academy));
	}
	public function upload_a_message(Request $request){//將新增的主題，上載到資料庫
	  	Main_discussion::create([
			'username'=>Auth::user()->name,
			'title'=>$request->title,
			'subject'=>$request->subject,
			'content'=>$request->content,
			'academy'=>$request->academy,
			'hide_name'=>$request->hide_name
		]);
	        return redirect('/browse_all_message_literature/'.$request->academy);		
	}
        public function browse_one_message($id){
		
		$discussion=Main_discussion::find($id);
		
		$messages=DB::table('sub_discussion')->where('main_discussion_id',$id)->orderBy('updated_at','DESC')->get();

        	$replys=DB::table('reply_sub_discussion')->orderBy('updated_at','DESC')->get();

	        return view('browse_one_message',array('messages'=>$messages,'replys'=>$replys,'username'=>$discussion->username,'title'=>$discussion->title,'subject'=>$discussion->subject,'content'=>$discussion->content,'academy'=>$discussion->academy,'hide_name'=>$discussion->hide_name,'id'=>$id));
	}
	public function make_sub_message(Request $request){
		Sub_discussion::create([
			'username'=>Auth::user()->name,
			'content'=>$request->content,
			'main_discussion_id'=>$request->id
		]);
		
		return redirect('browse_all_message_literature/browse_one_message/'.$request->id);
	}
	public function reply(Request $request){
	
		return view('reply',array('status'=>$request->status,'sub_discussion_id'=>$request->sub_discussion_id,'id'=>$request->id));
	}
	public function message_delete(Request $request){
		$message_object=Sub_discussion::find($request->sub_discussion_id);
		$message_object->delete();
		return redirect('browse_all_message_literature/browse_one_message/'.$request->id);		
	}
	public function message_fix(Request $request){
	

		return view('reply',array('sub_discussion_id'=>$request->sub_discussion_id,'content'=>$request->content,'id'=>$request->id,'status'=>$request->status));	

	}
	public function reply_fix(Request $request){
		return view('reply',array('content'=>$request->content,'id'=>$request->id,'status'=>$request->status,'reply_sub_discussion_id'=>$request->replyId));
	}
	public function reply_delete(Request $request){
		$reply_object=Reply_sub_discussion::find($request->reply_sub_discussion_id);
		$reply_object->delete();
		return redirect('browse_all_message_literature/browse_one_message/'.$request->id);


	}


	public function test_polling(){
		usleep(10000000);
		$a='a';
		return response()->json($a);
	}

}
