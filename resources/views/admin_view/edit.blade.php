@extends('layouts.app')

@section('content')


<div class="row justify-content-center">
	<form action="{{route('admin.update', $article->id)}}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('patch')
		<div class="form-group">
			<input  type="text" class="form-control" name="Title" value="{{$article->Title}}"/><br>
			<textarea style="resize: none;" class="form-control" name="Body" rows="10" cols="100">{{$article->Body}}</textarea><br>
		</div>
		<input class="btn btn-secondary" type="submit" value="Edit the article">
		<input class="btn btn-primary" name="Picture" type="file">
		@if($article->Article_hide == true)
			<input type="checkbox" name="Article_hide" checked="true">Hide Article
		@else
			<input type="checkbox" name="Article_hide">Hide Article
		@endif
		@if($article->Picture_existance == false)

		@else
			<input type="checkbox" name="Picture_existance">Delete picture
		@endif
	</form>
</div>



@endsection