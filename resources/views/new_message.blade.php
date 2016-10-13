@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/new_message.css')}}">
@stop

@section('content')
<div class="container">
    <div class="row">
	<div class="col-md-10 col-md-offset-1">
	    <div class="panel panel-default">
		<div class="panel-heading">
		    <p>{{Auth::user()->name}}您好！</p>
		</div>
		<div class="panel-body">
		    <form method="POST" action="upload_a_message" accept-charset="UTF-8" class="form-horizontal">
			{!! csrf_field() !!}
			<div class="form-group"> 
			    <label for="title">標題</label></br>
			    <input type="text" id="title" name="title" placeholder="請輸入標題" class="form-control">
			</div>
			<div class="form-group">
			    <label for="subject">討論科目</label></br>
			    <input type="text" id="subject" name="subject" placeholder="輸入科目" class="form-control">
			</div>
			<div>
			    <label>是否匿名</label></br>
				
			    <label class="radio-inline"><input type="radio" name="hide_name" id="hide_name_1" value="yes" checked>是</label>
			    <label class="radio-inline"><input type="radio" name="hide_name" id="hide_name_2" value="no">否</label>

			</div>
			<div class="form-group">
			    <label for="content">內容描述</label></br>
			    <textarea id="content" name="content" class="form-control" rows="5"></textarea>
			</div>
			<div>
			    <input type="hidden" name="academy" id="academy" value="{{$academy}}" />
			    <button value="submit" type="submit" class="btn btn-default">送出</button>
		 	</div>
		    </form>
		</div>
	    </div>
	</div>
    </div>
</div>
@endsection
