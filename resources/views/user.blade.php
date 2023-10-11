@extends('layouts.default')

@section('content')
<div class="col-12 col-lg-5">
    <div class="section-title">
        Ваши комментарии
    </div>

    @foreach($user->comments as $comment)
    <div class="comment-item">
        {{$comment->text}}

        <div class="comment-item__bottom">
            К материалу: <b>{{$comment->object->title_ru}}</b>
        </div>
    </div>
    @endforeach
</div>

<style>
    .comment-item {
        margin-top: 30px;
    }
</style>
@stop