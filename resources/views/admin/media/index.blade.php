@extends('layouts.admin')

@section('content')
	<h1>Media</h1>
@if(Session :: has('created'))
	<p class="bg-danger">{{session('created')}}</p>
@elseif(Session :: has('deleted'))
	<p class="bg-danger">{{session('deleted')}}</p>	
@endif
	@if($photos)
	<form action="delete/media" method="post" class="form-inline">
	{{csrf_field()}}
	{{method_field('delete')}}
	<div class="form-group">
		<select name="checkboxArray" id="" class="form-control">
			<option value="">Delete</option>
		</select>
	</div>
	<div class="form-group">
		<input type="submit" name="delete_all" class="btn btn-primary">
	</div>
	<table class="table">
		<thead>
			<tr>
				<th><input type="checkbox" id="options"></th>
				<th>Id</th>
				<th>Name</th>
				<th>Created at</th>
			</tr>
		</thead>
		<tbody>
		@foreach($photos as $photo)
			<tr>
				<td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}"></td>
				<td>{{$photo->id}}</td>
				<td><img height="50" src="{{$photo->file ? $photo->file : 'http://placehold.it/400x400'}}" alt=""></td>
				<td>{{$photo->create_at ? $photo->create_at : 'No Date'}}</td>
				<td><input type="hidden" name="photo" value="{{$photo->id}}"></td>	
			</tr>
		@endforeach	
		</tbody>
	</table>
	</form>
	@endif
	
@stop
@section('scripts')
	<script>
		$(document).ready(function(){
			$('#options').click(function(){
				if(this.checked){
					$('.checkBoxes').each(function(){
						this.checked = true;
					});
				}else{
					$('.checkBoxes').each(function(){
						this.checked = false;
					});
				}
				console.log('works')
			});
		});
	</script>
@stop