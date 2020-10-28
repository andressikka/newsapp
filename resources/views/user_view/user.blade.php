@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row row-cols-4">
		@foreach($news as $article)

			@if($article->Article_hide == true)
				@continue
			@else
				<div class="column">
					<div class="card border-0 p-1" style="width: 18rem;">
						@if($article->Picture)
							<img class="card-img-top" src="{{asset('/storage/images/'.$article->Picture)}}" width="286" height="180">	
						@endif 
							<div class="card-body" style="height:300px;">
								<a href="{{route('article', $article->id)}}">
									<h4 class="card-title" >{{$article->Title}}</h4>
								</a>	

								@if(strlen($article->Body) >= 150)
									<p class="card-text">{{substr($article->Body, 0, 150)}}...</p>
								@else
									<p class="card-text">{{$article->Body}}</p>
								@endif
							</div>
			@endif
				</div>
			</div>	
		@endforeach
	</div>
</div>
@endsection