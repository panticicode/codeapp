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
	<img class="img-responsive" src="{{$post->photo ? $post->photo->file : $post->photoPlaceholder() . '700x200' }}" alt="">
	<hr>
	<!-- Post Content -->
	
	<p>{!! $post->body !!}</p>
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
	@if(Session :: has('reply_message'))
		{{session('reply_message')}}
	@endif
		@if(count($comments) > 0)
			@foreach($comments as $comment)
			<!-- Posted Comments -->
			<!-- Comment -->
			<div class="media">
				<a class="pull-left" href="#">
					<img height="64" class="media-object" src="{{$comment->photo}}" alt="">
				</a>
				<div class="media-body">
					<h4 class="media-heading">{{$comment->author}}
						<small>{{$comment->created_at->diffForHumans()}}</small>
					</h4>
					{{$comment->body}}
					
					<!-- Nested Comment -->
					@if(count($comment->replies) > 0)
						@foreach($comment->replies as $reply)
							@if($reply->is_active == 1)
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
							</div>
							@endif	
						@endforeach
					@endif
					<div class="comment-reply-container">
						<button class="toggle-reply btn btn-primary pull-right">Reply</button>
						<div class="comment-reply col-sm-12">
						{!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReplay']) !!}
						<input type="hidden" name="comment_id" value="{{$comment->id}}">
						<div class="form-group">
						{!! Form::label('Body', 'Body:') !!}
						{!! Form::textarea('body', null, ['class'=>'form-control','rows'=>1]) !!}
						</div>
						<div class="form-group">
						{!!Form::submit('Submit', ['class'=>'btn btn-primary'])!!}
						</div>
						{!! Form::close() !!}
						</div>
					</div>
					<!-- End Nested Comment -->
				</div>
			</div>
			@endforeach
		@endif
	@endif
@stop
@section('scripts')	
<script> 
	$(".comment-reply-container .toggle-reply").click(function(){
		$(this).next().slideToggle("slow");
	});
</script>
<!--DISQUS-->
<!--
<div id="disqus_thread"></div>
	<script>

	/**
	*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
	*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
	/*
	var disqus_config = function () {
	this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
	this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
	};
	*/
	(function() { // DON'T EDIT BELOW THIS LINE
	var d = document, s = d.createElement('script');
	s.src = 'https://codeapp-test.disqus.com/embed.js';
	s.setAttribute('data-timestamp', +new Date());
	(d.head || d.body).appendChild(s);
	})();
	</script>
	<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
	<script id="dsq-count-scr" src="//codeapp-test.disqus.com/count.js" async></script>
--><!--DISQUS-->
@stop