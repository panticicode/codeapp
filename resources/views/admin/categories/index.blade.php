@extends('layouts.admin')

@section('content')
<h1>Categories</h1>
@if(Session :: has('created'))
	<p class="bg-danger">{{session('created')}}</p>
@elseif(Session :: has('updated'))
	<p class="bg-danger">{{session('updated')}}</p>
@elseif(Session :: has('deleted'))
	<p class="bg-danger">{{session('deleted')}}</p>	
@endif
<div class="col-sm-6">
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
<div class="col-sm-6">
@if($categories)
	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<td>Name</td>
				<td>Created date</td>
			</tr>
		</thead>	
		<tbody>
			@foreach($categories as $category)
			<tr>
				<td>{{$category->id}}</td>
				<td><a href="{{route('admin.categories.edit', $category->id)}}">{{$category->name}}</a></td>
				<td>{{$category->created_at ? $category->created_at->diffForhumans() : 'No Date'}}</td>
			</tr>
			@endforeach	
		</tbody>
	</table>
@endif	
</div>
@stop