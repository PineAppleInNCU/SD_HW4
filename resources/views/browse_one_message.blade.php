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
			    @if ($hide_name=="yes")
				匿名
			    @else
			        {{$username}}
			    @endif
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
	  		              <div class="form-group">
	        	       	         <form id="form1" name="form1" method="post" action="/make_sub_message">
						  {!! csrf_field() !!}
						  <label for="content">{{Auth::user()->name}}來說點甚麼吧</label>
			              		  <textarea class="post form-control" rows="8" id="content" name="content"></textarea>

			            		  </br>

 					         <!--  <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
						  <input type="hidden" name="id" id="id" value="{{$id}}" />
			                	  <input type="submit" name="button" id="button" class="btn" value="送出留言" />
		        	         </form>
		             	      </div>
		                  </div>

		   	@endif	
			@foreach($messages as $message)
				<table width="100%" border="1px" class="sub_discussion_table table table-hover">
					<thead>
						@if (Auth::check())
							<tr>
								<td colspan="3">
									<!-- 回覆 -->
									<form method="post" action="reply">
									{!! csrf_field() !!}
									<input type="submit" name="send" class="btn btn-primary btn-block" value="回覆"/><!-- 想帶參數出去，該怎麼辦？ -->
									
									<input type="hidden" name="sub_discussion_id" id="sub_discussion_id" value="{{$message->id}}" />
									<input type="hidden" name="id" id="id" value="{{$id}}" />
									
									<input type="hidden" name="status" id="status" value="回覆" />
									</form>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<!-- 刪除 -->
									@if (Auth::user()->name === $message->username)
									
										<form method="post" action="message_delete">
										{!! csrf_field() !!}
										<input type="submit" name="send" class="btn btn-danger btn-block" value="刪除"/><!-- 想帶參數出去，該怎麼辦？ -->
										<input type="hidden" name="sub_discussion_id" id="sub_discussion_id" value="{{$message->id}}" />
										<input type="hidden" name="id" id="id" value="{{$id}}" />
										</form>
									@else
										<!-- <form method="post" action="index.php/message_delete_error"> -->
										<!-- {!! csrf_field() !!} -->
										<input type="submit" name="send" class="btn btn-danger btn-block"  value="刪除" onclick="alert('留言者才能刪除該留言')"/><!-- 想帶參數出去，該怎麼辦？ -->
										<!-- <input type="hidden" name="messageId" id="messageId" value="{{$message->id}}" /> -->
										<!-- </form> -->
									@endif
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<!-- 修改留言 -->	
									@if (Auth::user()->name === $message->username)
									
										<form method="post" action="message_fix">
										{!! csrf_field() !!}
										<input type="submit" name="send" class="btn btn-success btn-block" value="修改留言"/><!-- 想帶參數出去，該怎麼辦？ -->
										<input type="hidden" name="username" id="username" value="{{Auth::user()->name}}" />
										<input type="hidden" name="sub_discussion_id" id="sub_discussion_id" value="{{$message->id}}" />
										<input type="hidden" name="content" id="content" value="{{$message->content}}" />
										<input type="hidden" name="id" id="id" value="{{$id}}" />
										<input type="hidden" name="status" id="status" value="修改留言" />
										</form>
									@else
										<input type="submit" name="send" class="btn btn-success btn-block" value="修改留言" onclick="alert('留言者才能修改該留言')"/><!-- 想帶參數出去，該怎麼辦？ -->
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
							<td colspan="2" >{{$message->updated_at}}</td>i
						</tr>
						<tr>
							<td>留言內容</td>
							<td colspan="2" width="500" height="300"><p style="word-break:break-all;" width="400">{{$message->content}}</p></td>
						</tr>
						@foreach ($replys as $reply)
						@if ($message->id==$reply->sub_discussion_id)
						<tr>
							<td colspan="3" >{{$reply->username}}回覆</td>
						</tr>
						<tr>
							<td>回覆時刻</td>
							<td colspan="2">{{$reply->updated_at}}</td>
						</tr>	
						<tr>
							<td colspan="3"><p style="word-break:break-all;">{{$reply->content}}</p></td>
						</tr>
						@if (Auth::check())
						<tr>
						     <td colspan="3" >
									@if (Auth::user()->name === $reply->username)
									
										<form method="post" action="reply_fix">
										{!! csrf_field() !!}
										<input type="submit" name="send" class="btn btn-success btn-block" value="修改回覆"/><!-- 想帶參數出去，該怎麼辦？ -->
										<input type="hidden" name="username" id="username" value="{{Auth::user()->name}}" />
										<input type="hidden" name="replyId" id="replyId" value="{{$reply->id}}" />
										<input type="hidden" name="content" id="content" value="{{$reply->content}}" />
										<input type="hidden" name="id" name="id" value="{{$id}}" />
										<input type="hidden" name="status" id="status" value="修改回覆" />
										</form>
									@else
										<!-- <form method="post" action="index.php/message_delete_error"> -->
										<!-- {!! csrf_field() !!} -->
										<input type="submit" name="send" class="btn btn-success btn-block" value="修改回覆" onclick="alert('回覆者才能修改該回覆')"/><!-- 想帶參數出去，該怎麼辦？ -->
										<!-- <input type="hidden" name="messageId" id="messageId" value="{{$message->id}}" /> -->
										<!-- </form> -->
									@endif

						     </td>
						</tr>
						<tr>
						    <td colspan="3"> 
									@if (Auth::user()->name === $reply->username)
									
										<form method="post" action="reply_delete">
										{!! csrf_field() !!}
										<input type="submit" name="send" class="btn btn-danger btn-block" value="刪除回覆"/><!-- 想帶參數出去，該怎麼辦？ -->
										<input type="hidden" name="reply_sub_discussion_id" id="reply_sub_discussion" value="{{$reply->id}}" />
										<input type="hidden" name="id" id="id" value="{{$id}}" />
										</form>
									@else
										<!-- <form method="post" action="index.php/message_delete_error"> -->
										<!-- {!! csrf_field() !!} -->
										<input type="submit" name="send" class="btn btn-danger btn-block" value="刪除回覆" onclick="alert('回覆者才能刪除該回覆')"/><!-- 想帶參數出去，該怎麼辦？ -->
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
