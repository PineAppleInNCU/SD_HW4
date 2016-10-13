@extends('layouts.app')


@section('css')
<link rel="stylesheet" href="{{asset('css/browse_all_message.css')}}">
@stop
@section('js')
<script src="{{  asset('js/browse_all_message_literature.js') }}"></script>
@stop

@section('content')
<div class="container">
    <div class="row">
	<div class="col-md-10 col-md-offset-1">
	    <div class="panel panel-default">
		<div class="panel-heading form-group">
		   <label for="search-input"> welcome</label></br>
		    <input type="text" placeholder="尋找討論的科目或主旨 " id="search-input" class="form-control">
		    <style id="m-search"></style><!-- 及時搜尋 -->
		    @if (Auth::check())
			<form method="post" action="new_a_message" id="new_a_message" name="new_a_message">
				{!! csrf_field()  !!}				
		    		<button type="submit" class="btn btn-default">開新討論串</button>
				<input type="hidden" name="academy" id="academy" value="{{$academy}}"  />
			</form>
		    @endif
		</div>

		
		<div class="panel-body">
		    <table border="0px" width="100%" >
		        <tr>
			    <td width="25%">
			        編號
			    </td>
			    <td width="25%">
				科目名稱
			    </td>
			    <td width="25%">
				問題主旨
			    </td>
			    <td width="25%">
			  	發問人
			    </td>
			</tr>
		    </table>
		</div>
	
		@foreach ($discussions as $discussion)
	 	@if ($discussion->academy==="$academy")
			<div class="wrap" data-index="{{$discussion->title}}  {{$discussion->subject}}">	
			<a href="browse_one_message/{{$discussion->id}}">
			<div class="panel-body">
					<table  width="100%">
			   			<tr>
						    <td width="25%" class="all_message_browser">
							{{$discussion->id}}
						    </td>
						    <td width="25%" class="all_message_browser">
							{{$discussion->subject}}
						    </td>
						    <td width="25%" class="all_message_browser">
							{{$discussion->title}}
						    </td>
						    <td width="25%" class="all_message_browser">
							@if ($discussion->hide_name==="yes")
								匿名
							@else						
								{{$discussion->username}}
							@endif
						    </td>
						</tr>
					</table>
			</div>
			</a>
			</div>
		@endif
		@endforeach


	    </div>
	</div>
    </div>
</div> 
@endsection


