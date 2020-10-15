@extends('layouts.app')

@section('content')
	<div class="card-columns py-1 px-5">
		@foreach($news as $article)
		<div class="card">
				<div class="card-body">
					<h4 href="{{route('article', $article->id)}}" class="card-title">{{$article->Title}}</h4>
					@if($article->Picture)
						<img src="{{asset('/storage/images/'.$article->Picture)}}" height="150" width="300"  srcset="">	
					@endif 
					
					@if(strlen($article->Body) >= 150)
					<p class="card-text">{{substr($article->Body, 0, 150)}}...</p>
					@else
					<p class="card-text">{{$article->Body}}</p>
					@endif
					
					<a class="btn btn-primary" href="{{route('article', $article->id)}}">Open article</a>
				</div>
			</div>
		@endforeach
	</div>
@endsection