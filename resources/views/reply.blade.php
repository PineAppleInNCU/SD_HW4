@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/reply.css') }}">
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><pre>Reply    回覆人：{{Auth::user()->name}}     狀態：{{$status}}</pre></div>

                <div class="panel-body">

			<div class="form-group">
                                        <form id="form1" name="form1" method="post" action="reply_reply">
						{!! csrf_field() !!}
                                                <label for="content">內容</label>
						@if (isset($status))
							@if ($status==="回覆")
                                	        	        <textarea  rows="5" id="content" name="content" class="form-control"></textarea>
								<input type="hidden" name="sub_discussion_id" id="sub_discussion_id" value={{$sub_discussion_id}}  />
								<input type="hidden" name="status" id="status" value="{{$status}}" />
								<input type="hidden" name="id" id="id" value="{{$id}}" />
							@elseif ($status==="修改留言")
								<textarea  rows="5" id="content" name="content" class="form-control">{{$content}}</textarea>
								<input type="hidden" name="sub_discussion_id" id="sub_discussion_id" value={{$sub_discussion_id}}  />
								<input type="hidden" name="id" name="id" value="{{$id}}" />
								<input type="hidden" name="status" id="status" value="{{$status}}"/>
							@elseif ($status==="修改回覆")
								<textarea  rows="5" id="content" name="content" class="form-control">{{$content}}</textarea>
								<input type="hidden" name="reply_sub_discussion_id" id="reply_sub_discussion_id" value="{{$reply_sub_discussion_id}}" />
								<input type="hidden" name="id" id="id" value={{$id}}  />
								<input type="hidden" name="status" id="status" value="{{$status}}"/>
							@endif
						@else
							<textarea style="width:600px" rows="8" id="guestReply" name="guestReply"></textarea>

						@endif
                                                <input type="submit" name="button" id="button" class="btn btn-info btn-block" value="{{$status}}" />
                                        </form>
                         </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


