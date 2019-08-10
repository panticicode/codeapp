@extends('layouts.blog-post')

@section('content')
	<h1>Post</h1>
	<!-- Blog Post -->
	<!-- Title -->
	<h1>{{$post->title}}</h1>
	<!-- Author -->
	<p class="lead">
		by <a href="#">{{$post->user->name}}</a>
	</p>
	<hr>
	<!-- Date/Time -->
	<p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}
	<hr>
	<!-- Preview Image -->
	<img class="img-responsive" src="{{$post->photo->file}}" alt="">
	<hr>
	<!-- Post Content -->
	
	<p>{{$post->body}}</p>
	<hr>
	@if(Session :: has('comment_message'))
		{{session('comment_message')}}
	@endif
	<!-- Blog Comments -->
	@if(Auth :: user())
	<!-- Comments Form -->
	<div class="well">
		<h4>Leave a Comment:</h4>
		{!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}
		<input type="hidden" name="post_id" value="{{$post->id}}">
		<div class="form-group">
		{!!Form::label('body', 'Body:')!!}
		{!!Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3])!!}
		</div>	
		<div class="form-group">
		{!!Form::submit('Submit Comment ', ['class'=>'btn btn-primary'])!!}
		</div>
		{!! Form::close() !!}
	</div>
	<hr>
	<!-- Posted Comments -->
	@endif
	@if(count($comments) > 0)
		<!-- Comment -->
		@if(Session :: has('reply_message'))
			{{session('reply_message')}}
		@endif
		@foreach($comments as $comment)
		<div class="media">
			<a class="pull-left" href="#">
				<img height="64" class="media-object" src="{{$comment->photo}}" alt="">
				<!--IF YOU WANT A USE GRAVATAR YOU CAN-->
				<!--<img height="64" class="media-object" src="{{Auth::user()->gravatar}}" alt="">-->
			</a>
			<div class="comment-replay-container">
			<button class="toggle-replay btn btn-primary pull-right">Replay</button>
				<div class="comment-replay col-sm-12">
				{!! Form :: open(['method'=>'POST', 'action'=>'CommentRepliesController@createReplay']) !!}
				<input type="hidden" name="comment_id" value="{{$comment->id}}">
				<div class="form-group">
					{!! Form :: label('body', 'Body:') !!}
					{!! Form :: textarea('body', null, ['class'=>'form-control', 'rows'=>1]) !!}
				</div>
				<div class="form-group">
					{!! Form :: submit('Submit', ['class'=>'btn btn-primary'])!!}
				</div>
				{!! Form :: close() !!}
				</div>
			</div>
			<div class="media-body">
				<h4 class="media-heading">{{$comment->author}}
					<small>{{$comment->created_at->diffForHumans()}}</small>
				</h4>
				<p>{{$comment->body}}</p>
				<!-- Nested Comment -->
			@if(count($comment->replies) > 0)	
			@foreach($comment->replies as $reply)
				@if($reply->is_active == true)
				<div id="nested-comment" class="media">
					<a class="pull-left" href="#">
						<img height="64" class="media-object" src="{{$reply->photo}}" alt="">
					</a>
					<div class="media-body">
						<h4 class="media-heading">{{$reply->author}}
							<small>{{$reply->created_at->diffForHumans()}}</small>
						</h4>
						{{$reply->body}}
					</div>
					<div class="comment-replay-container">
					<button class="toggle-replay btn btn-primary pull-right">Replay</button>
						<div class="comment-replay col-sm-9">
						{!! Form :: open(['method'=>'POST', 'action'=>'CommentRepliesController@createReplay']) !!}
						<input type="hidden" name="comment_id" value="{{$comment->id}}">
						<div class="form-group">
							{!! Form :: label('body', 'Body:') !!}
							{!! Form :: textarea('body', null, ['class'=>'form-control', 'rows'=>1]) !!}
						</div>
						<div class="form-group">
							{!! Form :: submit('Submit', ['class'=>'btn btn-primary'])!!}
						</div>
						{!! Form :: close() !!}
						</div>
					</div>
				</div>
				<!-- End Nested Comment -->
				@else
					<!--<h1 class="text-center">No Replies</h1>-->
				@endif
			@endforeach
		@endif
		</div>
	</div>
	@endforeach
	@endif
@stop
@section('scripts')
<script>
	$(".comment-replay-container .toggle-replay").click(function(){
		$(this).next().slideToggle("slow");
	});
</script>
@stop