@extends('layouts.admin')
@include('includes.tinyeditor')	
@section('content')
<h1>Create Post</h1>
{!! Form::open(['method'=>'POST', 'action'=>'AdminPostController@store', 'files' => true]) !!}
<div class="row">	
	<div class="form-group">
		{!!Form::label('title', 'Title:')!!}
		{!!Form::text('title', null, ['class'=>'form-control'])!!}
	</div>	
	<div class="form-group">
		{!!Form::label('category_id', 'Category:')!!}
		{!!Form::select('category_id', [''=>'Choose Options'] + $categories, null, ['class'=>'form-control'])!!}
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
		{!!Form::submit('Create Post', ['class'=>'btn btn-primary'])!!}
	</div>
</div>	
{!! Form::close() !!}
<div class="row">
	@include('includes.form_error')	
</div>
@stop
