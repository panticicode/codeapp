@extends('layouts.admin')

@section('content')
@include('includes.tinyeditor')
<h1>Edit Post</h1>
{!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostController@update', $post->id], 'files' => true]) !!}
<div class="row">
	<div class="col-md-3">
		<img height="100" src="{{$post->photo ? '/laravel/' . $post->photo->file : $post->photoPlaceholder() . '400x400'}}" alt="">
	</div>
	<div class="col-md-9">	
		<div class="form-group">
			{!!Form::label('title', 'Title:')!!}
			{!!Form::text('title', null, ['class'=>'form-control'])!!}
		</div>	
		<div class="form-group">
			{!!Form::label('category_id', 'Category:')!!}
			{!!Form::select('category_id', $categories, null, ['class'=>'form-control'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('photo_id', 'Photo:')!!}
			{!!Form::file('photo_id', null, ['class'=>'form-control'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('Body', 'Description:')!!}
			{!!Form::textarea('body', null, ['class'=>'form-control'])!!}
		</div>
		<div class="form-group">
			{!!Form::submit('Update Post', ['class'=>'btn btn-primary col-sm-5'])!!}
		</div>
{!! Form::close() !!}
		<div class="col-sm-2"></div>
{!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostController@destroy', $post->id]]) !!}
	<div class="form-group">
	{!! Form::submit('Delete Post', ['class'=>'btn btn-danger col-sm-5']) !!}
	</div>
{!! Form::close() !!}
	</div>
</div>
<div class="row">
	@include('includes.form_error')	
</div>
@stop
