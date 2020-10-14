@extends('layouts.app')

@section('content')
	<div class="row justify-content-center">
		<form action="{{route('admin.store')}}" method="post">
			@csrf
			<div class="form-group">
				<input class="form-control" type="text" name="Title"/><br>
				<textarea style="resize: none;" class="form-control" rows="10" cols="100" name="Body"></textarea><br>
				<input class="btn btn-primary" type="submit" value="Post the article">
			</div>
		</form>
	</div>
@endsection