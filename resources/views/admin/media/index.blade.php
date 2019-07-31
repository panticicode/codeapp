@extends('layouts.admin')

@section('content')
	<h1>Media</h1>
@if(Session :: has('created'))
	<p class="bg-danger">{{session('created')}}</p>
@elseif(Session :: has('deleted'))
	<p class="bg-danger">{{session('deleted')}}</p>	
@endif
	@if($photos)
	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Created at</th>
			</tr>
		</thead>
		<tbody>
		@foreach($photos as $photo)
			<tr>
				<td>{{$photo->id}}</td>
				<td><img height="50" src="{{$photo->file ? $photo->file : 'http://placehold.it/400x400'}}" alt=""></td>
				<td>{{$photo->create_at ? $photo->create_at : 'No Date'}}</td>
				<td>
				{!! Form :: open(['method'=>'DELETE', 'action'=> ['AdminMediaController@destroy', $photo->id ]]) !!}
					<div class="form-group">
					{!! Form :: submit('Delete Photo', ['class'=>'btn btn-danger']) !!}
					</div>
				{!! Form :: close() !!}
				</td>
					
			</tr>
		@endforeach	
		</tbody>
	</table>
	@endif
@stop