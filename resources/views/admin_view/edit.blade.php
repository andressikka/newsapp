@extends('layouts.app')

@section('content')


<div class="row justify-content-center">
	<form action="{{route('admin.update', $article->id)}}" method="POST">
		@csrf
		@method('patch')
		<div class="form-group">
			<input  type="text" class="form-control" name="Title" value="{{$article->Title}}"/><br>
			<textarea style="resize: none;" class="form-control" name="Body" rows="10" cols="100">{{$article->Body}}</textarea><br>
		</div>
		<input class="btn btn-secondary" type="submit" value="Post the article">
	</form>
</div>



@endsection