@extends('layouts.admin')

@section('content')
<h1>Forms</h1>
<div class="col-sm-6">
{!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}
	<div class="row">	
		<div class="form-group">
		{!!Form::label('name', 'Name:')!!}
		{!!Form::text('name', null, ['class'=>'form-control'])!!}
		</div>	
		<div class="form-group">
		{!!Form::submit('Create ', ['class'=>'btn btn-primary'])!!}
		</div>
	</div>	
	{!! Form::close() !!}
	<div class="row">
	{!! Form::model(@$category, ['method'=>'PATCH', 'action'=>['AdminCategoriesController@update', @$category->id ]]) !!}
		<div class="form-group">
		{!!Form::label('name', 'Name:')!!}
		{!!Form::text('name', null, ['class'=>'form-control'])!!}
		</div>	
		<div class="form-group">
		{!!Form::submit('Update ', ['class'=>'btn btn-primary col-sm-5'])!!}
		</div>
		{!! Form::close() !!}
		<div class="col-sm-2"></div>
		{!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy', @$category->id]]) !!}
		<div class="form-group">
		{!!Form::submit('Delete Category', ['class'=>'btn btn-danger col-sm-5'])!!}
		</div>
		{!! Form::close() !!}
	</div>	
</div>
<div class="col-sm-6">
	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<td>Name</td>
				<td>Created date</td>
			</tr>
		</thead>	
		<tbody>
			<tr>
				<td>id 1</td>
				<td>name 1</td>
				<td>create 1</td>
			</tr>
			<tr>
				<td>id 2</td>
				<td>name 2</td>
				<td>create 2</td>
			</tr>
		</tbody>
	</table>

</div>
@stop