@if(Session::has('flash_message'))

	<div class="alert alert-success {{Session::has('penting') ? 'alert-important':''}} " style="margin-top: 10px;margin-bottom: 10px;">

	   <button type="button" class="close" data-dismiss="alert" aria-label="close">&times;</button>

  		{{Session::get('flash_message')}}

	</div>

 {{ Session::forget('flash_message') }}

@endif