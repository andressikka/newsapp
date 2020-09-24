@extends('layouts.app')

@section('content')
	<div class="row justify-content-center">
		<form href="{{route('admin.store')}}" method="post">
			@csrf
			<input type="text" name="Title"><br>
			<textarea name="Body"></textarea><br>
			<input type="submit" value="Post the article">
		</form>
	</div>
@endsection