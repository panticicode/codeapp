@extends('layouts.admin')

@section('content')
<h1>Posts</h1>
@if(Session :: has('created'))
	<p class="bg-danger">{{session('created')}}</p>
@elseif(Session :: has('updated'))
	<p class="bg-danger">{{session('updated')}}</p>
@elseif(Session :: has('deleted'))
	<p class="bg-danger">{{session('deleted')}}</p>	
@endif
<table class="table table-striped">
	<thead>
	<tr>
		<th>Id</th>
		<th>Photo</th> 
		<th>Owner</th>
		<th>Category</th>
		<th>title</th>
		<th>body</th>
		<th>Created</th>
		<th>Updated</th>
	</tr>
	</thead>
	<tbody>
	@if($posts)
	@foreach($posts as $post)
	<tr>
		<td>{{$post->id}}</td>
		<td><img height="50" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/400x400'}}" alt=""></td>
		<td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->user->name}}</a></td>
		<td>{{$post->category ? $post->category->name : 'Uncategerized'}}</td>
		<td>{{$post->title}}</td>
		<td>{{$post->body}}</td>
		<td>{{$post->created_at->diffForHumans()}}</td>{{----CARVIN METHODS----}}
		<td>{{$post->updated_at->diffForHumans()}}</td>{{----CARVIN METHODS----}}
	</tr>
	@endforeach
	@endif
	</tbody>
</table>
@stop