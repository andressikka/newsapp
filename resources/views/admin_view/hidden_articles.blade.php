@extends('layouts.app')

@section('content')
	<div class="container">

		<div class="row">
			<a href="/articles" class="btn btn-danger">Back</a>
		</div>
		
			@foreach($hiddenArticles as $hArticle)
				<div class="row">
					<div class="col-10 list-group-item"><h4>{{$hArticle->Title}}</h4></div>
					<div class="col-2 list-group-item">
						<a class="btn btn-primary" href="{{route('admin.edit', $hArticle->id)}}">Edit</a>

						<form action="{{route('admin.destroy', $hArticle->id)}}" id="{{'form-delete-'.$hArticle->id}}" style="display:none" method="post">
							@csrf
							@method('delete')
						</form>
						
						<a class="btn btn-danger" onclick="event.preventDefault();
												document.getElementById('form-delete-{{$hArticle->id}}').submit();">Delete</a>
					</div>
				</div>
			@endforeach
	</div>
@endsection