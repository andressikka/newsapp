@extends('layouts.app')

@section('content')
<div class="media justify-content-center">
    <div class="media-body">
        <h3 class="mt-0">{{$article->Title}}</h3>
        <p>{{$article->Body}}</p>
    </div>
</div>
<a class="btn btn-primary" href="">Leave comment</a>
<a class="btn btn-danger" href="{{route('newsPage')}}">Back</a>
@endsection