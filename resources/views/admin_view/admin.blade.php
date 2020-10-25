@extends('layouts.app')

@section('content')

	<script>
		function cbStatus(element) {
			if (element.checked) {
				element.value=1;
			} else {
				element.value=0;
		}	
		}
		
	</script>

	<div class="row justify-content-center">
		<form action="{{route('admin.store')}}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<input autocomplete="off" class="form-control" type="text" name="Title"/><br>
				<textarea style="resize: none;" class="form-control" rows="10" cols="100" name="Body"></textarea><br>
				<input class="btn btn-primary" type="submit" value="Post the article">
				<input class="btn btn-primary" name="Picture" type="file">
				<input type="checkbox" name="Article_hide">Hide Article
			</div>
		</form>
	</div>
@endsection