@extends('layouts.app')

@section('content')
<h2 class="row justify-content-center">Comment section</h2>
<div class="row justify-content-center">
    <form action="{{route('comment_section.store')}}" method="post">
        @csrf
        <div class="form-group">
            <input class="form-control" type="text" name="Nickname"/><br>
            <textarea style="resize: none;" rows="10" cols="100" name="CommentBody"></textarea><br>
            <input type="hidden" name="FK_Article_Id" value="{{$articleId}}"/>
            <input class="btn btn-primary"  type="submit" value="Post the comment"/>
        </div>
    </form>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="list-group text-center w-75">
            <p style="margin-bottom: 40px; font-size:large;" class="list-group-item list-group-item-action list-group-item-info font-weight-bold text-uppercase">Comments</p>
        </div>
    </div>

        @foreach($comments as $comment)
        <div class="container">
            <div class="row justify-content-center">
                <div class="list-group w-75">
                    <p style="margin-bottom: 0px;" class="list-group-item list-group-item-action list-group-item-dark font-weight-bold">{{$comment->Nickname}}</p>        
                    <p class="list-group-item font-weight-normal ">{{$comment->CommentBody}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

        
        
    

@endsection()