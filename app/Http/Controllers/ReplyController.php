<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
use App\Reply;
use App\Guest;
use App\User;
use App\Main_discussion;
use App\Sub_discussion;
use App\Reply_sub_discussion;
use Auth;

class ReplyController extends Controller
{
    //
    public function index(Request $request){

	



	return view('reply',array('username'=>$request->username,'messageId'=>$request->messageId,'status'=>$request->status));

    }
    public function reply(Request $request){

	if($request->status==="回覆"){
		Reply_sub_discussion::create([
			'username' =>Auth::user()->name,
			'content'=>$request->content,
			'sub_discussion_id'=>$request->sub_discussion_id
		]);
	//echo $request->guestReply; //檢查是否為問號
		return redirect('browse_all_message_literature/browse_one_message/'.$request->id);
	}
	else if($request->status==="修改留言"){
		$curcor=sub_discussion::find($request->sub_discussion_id);
	        $curcor->content=$request->content;	
		$curcor->save();		
		return redirect('browse_all_message_literature/browse_one_message/'.$request->id);
	}
	else if($request->status==="修改回覆"){
		$curcor=Reply_sub_discussion::find($request->reply_sub_discussion_id);
		$curcor->content=$request->content;
		$curcor->save();
		return redirect('browse_all_message_literature/browse_one_message/'.$request->id);
	}

	return	redirect('/');
    }
    public function reply_delete(Request $request){//刪除留言
	$message_object = Reply::find($request->messageId);
	$message_object->delete();
	
	return redirect('/');
    }
    

}
