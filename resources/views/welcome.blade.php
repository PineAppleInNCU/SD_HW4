@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
	    <div class="panel panel-default">
		<div class="panel-heading">討論主題</div>
		<div class="panel-body">
		    <div>
			<label>
			    討論發起人
		        </label>
			<p>
			    {{$username}}
			</p>
		    </div>
		    <div>
			<label>
			    標題
			</label>
			<p>
			    {{$title}}
			</p>
		    </div>
		    <div>
			<label>
			    討論科目
			</label>
			<p>
			    {{$subject}}
			</p>
		    </div>   
		    <div>
			<label>
			    討論內容
			</label>
			<div id="main_discussion_container">
			    <pre  id="main_discussion">{{$content}}</pre>
			</div>
		    </div>
		</div>
	
	    </div>

            <div class="panel panel-default">
                <div class="panel-heading">討論串</div>
                <div class="panel-body">
			@if (Auth::check())		
                   		
				
			         <div>
	             			 <P><font>{{Auth::user()->name}}</font>來說點甚麼吧</P>
	  		              <div>
	        	       	         <form id="form1" name="form1" method="post" action="index.php/make_message">
						  {!! csrf_field() !!}
			              		  <textarea class="post" rows="8" id="guestContent" name="guestContent"></textarea>

			            		  </br>

 					         <!--  <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
			                	  <input type="submit" name="button" id="button" value="送出留言" />
		        	         </form>
		             	      </div>
		                  </div>

		   	@endif	
			@foreach($messages as $message)
				<table height="300" border="1px" class="sub_discussion_table">
					<thead>
						@if (Auth::check())
							<tr>
								<td>
									<form method="post" action="index.php/reply">
									{!! csrf_field() !!}
									<input type="submit" name="send" value="回覆"/><!-- 想帶參數出去，該怎麼辦？ -->
									<input type="hidden" name="username" id="username" value="{{$message->username}}" />
									<input type="hidden" name="messageId" id="messageId" value="{{$message->id}}" />
									<input type="hidden" name="status" id="status" value="回覆" />
									</form>
								</td>
								<td>
									@if (Auth::user()->name === $message->username)
									
										<form method="post" action="index.php/message_delete">
										{!! csrf_field() !!}
										<input type="submit" name="send" value="刪除"/><!-- 想帶參數出去，該怎麼辦？ -->
										<input type="hidden" name="messageId" id="messageId" value="{{$message->id}}" />
										</form>
									@else
										<!-- <form method="post" action="index.php/message_delete_error"> -->
										<!-- {!! csrf_field() !!} -->
										<input type="submit" name="send" value="刪除" onclick="alert('留言者才能刪除該留言')"/><!-- 想帶參數出去，該怎麼辦？ -->
										<!-- <input type="hidden" name="messageId" id="messageId" value="{{$message->id}}" /> -->
										<!-- </form> -->
									@endif
								</td>		
								<td>
	
									@if (Auth::user()->name === $message->username)
									
										<form method="post" action="index.php/message_fix">
										{!! csrf_field() !!}
										<input type="submit" name="send" value="修改留言"/><!-- 想帶參數出去，該怎麼辦？ -->
										<input type="hidden" name="username" id="username" value="{{Auth::user()->name}}" />
										<input type="hidden" name="messageId" id="messageId" value="{{$message->id}}" />
										<input type="hidden" name="content" id="content" value="{{$message->content}}" />
										<input type="hidden" name="status" id="status" value="修改留言" />
										</form>
									@else
										<!-- <form method="post" action="index.php/message_delete_error"> -->
										<!-- {!! csrf_field() !!} -->
										<input type="submit" name="send" value="修改留言" onclick="alert('留言者才能修改該留言')"/><!-- 想帶參數出去，該怎麼辦？ -->
										<!-- <input type="hidden" name="messageId" id="messageId" value="{{$message->id}}" /> -->
										<!-- </form> -->
									@endif
								</td>
							</tr>
						@endif
					</thead>
					<tbody>
						<tr>
							<td>留言人</td>
							<td colspan="2">{{$message->username}}</td>
						</tr>
						<tr>
							<td>留言時刻</td>
							<td colspan="2" >{{$message->guestTime}}</td>
						</tr>
						<tr>
							<td>留言內容</td>
							<td colspan="2" width="500" height="300"><p style="word-break:break-all;" width="400">{{$message->content}}</p></td>
						</tr>
						@foreach ($replys as $reply)
						@if ($message->id==$reply->messageId)
						<tr>
							<td colspan="3" >{{$reply->username}}回覆</td>
						</tr>
						<tr>
							<td>回覆時刻</td>
							<td colspan="2">{{$reply->replyTime}}</td>
						</tr>	
						<tr>
							<td colspan="3"><p style="word-break:break-all;">{{$reply->content}}</p></td>
						</tr>
						@if (Auth::check())
						<tr>
						     <td colspan="3" >
									@if (Auth::user()->name === $reply->username)
									
										<form method="post" action="index.php/reply_fix">
										{!! csrf_field() !!}
										<input type="submit" name="send" value="修改回覆"/><!-- 想帶參數出去，該怎麼辦？ -->
										<input type="hidden" name="username" id="username" value="{{Auth::user()->name}}" />
										<input type="hidden" name="replyId" id="replyId" value="{{$reply->id}}" />
										<input type="hidden" name="content" id="content" value="{{$reply->content}}" />
										<input type="hidden" name="status" id="status" value="修改回覆" />
										</form>
									@else
										<!-- <form method="post" action="index.php/message_delete_error"> -->
										<!-- {!! csrf_field() !!} -->
										<input type="submit" name="send" value="修改回覆" onclick="alert('回覆者才能修改該回覆')"/><!-- 想帶參數出去，該怎麼辦？ -->
										<!-- <input type="hidden" name="messageId" id="messageId" value="{{$message->id}}" /> -->
										<!-- </form> -->
									@endif

						     </td>
						</tr>
						<tr>
						    <td colspan="3"> 
									@if (Auth::user()->name === $reply->username)
									
										<form method="post" action="index.php/reply_delete">
										{!! csrf_field() !!}
										<input type="submit" name="send" value="刪除"/><!-- 想帶參數出去，該怎麼辦？ -->
										<input type="hidden" name="messageId" id="messageId" value="{{$reply->id}}" />
										</form>
									@else
										<!-- <form method="post" action="index.php/message_delete_error"> -->
										<!-- {!! csrf_field() !!} -->
										<input type="submit" name="send" value="刪除" onclick="alert('回覆者才能刪除該回覆')"/><!-- 想帶參數出去，該怎麼辦？ -->
										<!-- <input type="hidden" name="messageId" id="messageId" value="{{$message->id}}" /> -->
										<!-- </form> -->
									@endif
						    </td>
						</tr>
						@endif
						@endif	
						@endforeach
					</tbody>
				</table>
			@endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
