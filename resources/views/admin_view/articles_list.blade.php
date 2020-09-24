@extends('layouts.app')

@section('content')
	
	<div class="container">
			@foreach($articles as $article)
				<div class="row">
					<div class="col-10 list-group-item"><h4>{{$article->Title}}</h4></div>
					<div class="col-2 list-group-item">
						<a class="btn btn-primary" href="{{route('admin.edit', $article->id)}}">Edit</a>

						<form action="{{route('admin.destroy', $article->id)}}" id="{{'form-delete-'.$article->id}}" style="display:none" method="post">
							@csrf
							@method('delete')
						</form>
						
						<a class="btn btn-danger" onclick="event.preventDefault();
												document.getElementById('form-delete-{{$article->id}}').submit();">Delete</a>
					</div>
				</div>
			@endforeach
	</div>
	
@endsection