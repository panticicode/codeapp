@extends('layouts.admin')

@section('content')
@if(Session :: has('created'))
	<p class="bg-danger">{{session('created')}}</p>
@elseif(Session :: has('updated'))
	<p class="bg-danger">{{session('updated')}}</p>
@elseif(Session :: has('deleted'))
	<p class="bg-danger">{{session('deleted')}}</p>	
@endif
	<h1>Users</h1>
	<table class="table table-striped">
	<thead>
	<tr>
		<th>Id</th>
		<th>Photo</th>
		<th>Name</th>
		<th>Email</th>
		<th>Role</th>
		<th>Active</th>
		<th>Created</th>
		<th>Updated</th>
	</tr>
	</thead>
	<tbody>
	@if($users)
	@foreach($users as $user)
	<tr>
		<td>{{$user->id}}</td>
		<td><img height="50" src="{{$user->photo ? $user->photo->file : 'http://placehold.it/400x400'}}" alt=""></td>
		<td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
		<td>{{$user->email}}</td>
		<td>{{$user->role ? $user->role->name : false}}</td>
		<td>{{$user->is_active == 1 ? 'Active' : 'No Active'}}</td>
			{{--<td>{{$user->created_at}}</td>--}}
			{{--<td>{{$user->updated_at}}</td>--}}
		<td>{{$user->created_at->diffForHumans()}}</td>{{----CARVIN METHODS----}}
		<td>{{$user->updated_at->diffForHumans()}}</td>{{----CARVIN METHODS----}}
	</tr>
	@endforeach
	@endif
	</tbody>
	</table>
@stop