@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row row row-cols-4">
		@foreach($news as $article)
			<div class="column">
				<div class="card border-0 p-1" style="width: 18rem;">
					@if($article->Article_hide == true)
						@continue
					@else
							@if($article->Picture)
								<img class="card-img-top" src="{{asset('/storage/images/'.$article->Picture)}}" width="286" height="180">	
							@endif 
						<div class="card-body">
							<h4 class="card-title" href="{{route('article', $article->id)}}">{{$article->Title}}</h4>	

							@if(strlen($article->Body) >= 150)
							<p class="card-text">{{substr($article->Body, 0, 150)}}...</p>
							@else
							<p class="card-text">{{$article->Body}}</p>
							@endif


							<a class="btn btn-primary" href="{{route('article', $article->id)}}">Open article</a>

						</div>
					@endif
				</div>
			</div>	
		@endforeach
	</div>
</div>
@endsection