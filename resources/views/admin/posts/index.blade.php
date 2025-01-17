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
		<th>Posts</th>
		<th>Comments</th>
		<th>Created</th>
		<th>Updated</th>
	</tr>
	</thead>
	<tbody>
	@if($posts)
	@foreach($posts as $post)
	<tr>
		<td>{{$post->id}}</td>
		<td><img width="90" height="50" src="{{$post->photo ? '/laravel/' . $post->photo->file : 'http://placehold.it/400x400'}}" alt=""></td>
		<td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->user->name}}</a></td>
		<td>{{$post->category ? $post->category->name : 'Uncategerized'}}</td>
		<td>{{$post->title}}</td>
		<td>{{substr($post->body,0,100)}}</td>
		<td><a href="{{route('home.post', $post->slug)}}">View Post</a></td>
		<td><a href="{{route('admin.comments.show', $post->id)}}">View Comment</a></td>
		<td>{{$post->created_at->diffForHumans()}}</td>{{----CARVIN METHODS----}}
		<td>{{$post->updated_at->diffForHumans()}}</td>{{----CARVIN METHODS----}}
	</tr>
	@endforeach
	@endif
	</tbody>
</table>
<div class="row">
	<div class="col-sm-6 col-sm-offset-5">
		{{$posts->render()}}
	</div>
</div>
@stop