@extends('layouts.app')

@section('content')
	<div class="card-columns py-1 px-5">
		@foreach($news as $article)
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{$article->Title}}</h4>
					<p class="card-text">{{$article->Body}}</p>
					<a href="#!" class="btn btn-primary">Open articl</a>
				</div>
			</div>
		@endforeach
	</div>
@endsection