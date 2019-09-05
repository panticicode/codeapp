@extends('layouts.admin')

@section('content')
<h1>Comment</h1>
@if(count($comments) > 0)
<table class="table">
	<thead>
		<tr>
			<th>Id</th>
			<td>Author</td>
			<td>Email</td>
			<td>Body</td>
			<td>Post</td>
		</tr>
	</thead>	
	<tbody>
	@foreach($comments as $comment)
		<tr>
			<td>{{$comment->id}}</td>
			<td>{{$comment->author}}</td>
			<td>{{$comment->email}}</td>
			<td>{{$comment->body}}</td>
			<td><a href="{{route('home.post', $comment->post->slug)}}">View Post</a></td>
			<td>
			@if($comment->is_active == true)
			{!! Form::open(['method'=>'PATCH', 'action'=> ['PostCommentsController@update', $comment->id]]) !!}
			<input type="hidden" name="is_active" value="0">
			<div class="form-group">
			{!!Form::submit('Un-approve ', ['class'=>'btn btn-success'])!!}
			</div>
			{!! Form::close() !!}
				@else
				{!! Form::open(['method'=>'PATCH', 'action'=> ['PostCommentsController@update', $comment->id]]) !!}
				<input type="hidden" name="is_active" value="1">
				<div class="form-group">
				{!!Form::submit('Approve ', ['class'=>'btn btn-info'])!!}
				</div>
				{!! Form::close() !!}	
			@endif
			</td>
			<td>
			{!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id]]) !!}
			<div class="form-group">
			{!!Form::submit('Delete', ['class'=>'btn btn-danger'])!!}
			</div>
			{!! Form::close() !!}
			</td>
		</tr>
	@endforeach	
	</tbody>
</table>
@else
<h1 class="text-center">No comments</h1>	
@endif
@stop()