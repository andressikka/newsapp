@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="media justify-content-center">
            <div class="media-body justify-content-center">
                <h3 class="mt-0">{{$article->Title}}</h3>
                @if($article->Picture)
                    <img class="card-img-top" style="padding-bottom: 23px;" src="{{asset('/storage/images/'.$article->Picture)}}">   
                @endif 
                <p>{{$article->Body}}</p>
                
                <a class="btn btn-primary" href="{{route('comment_section.show', $article->id)}}">Leave comment</a>
                <a class="btn btn-danger" href="{{route('newsPage')}}">Back</a>
            </div>
        </div>
    </div>

</div>


@endsection