@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/messenger.css')}}" >
@stop
@section('js')
<script src="{{asset('js/messenger.js')}}"></script>
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">messenger</div>

                <div class="panel-body " id="message_board">
                    <div class="well" id="message_board_2">
			@foreach ($messages as $message)
				<pre class="messages">{{$message->username}}：{{$message->message}}</pre>
			@endforeach
		    </div>
		    <div>
		    	<input type="text" id="add_message_text" />
		    	<button   id="add_message">test</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection





