@extends('layouts.admin')

@section('content')
<h1>Create Category</h1>
<div class="col-sm-12">
{!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}
<div class="row">	
	<div class="form-group">
		{!!Form::label('name', 'Name:')!!}
		{!!Form::text('name', null, ['class'=>'form-control'])!!}
	</div>	
	<div class="form-group">
		{!!Form::submit('Create Category', ['class'=>'btn btn-primary'])!!}
	</div>
</div>	
{!! Form::close() !!}
</div>
<div class="row">
	@include('includes.form_error')	
</div>
@stop