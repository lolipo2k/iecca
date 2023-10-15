@extends('layouts.default')

@section('content')
<div class="col-12 col-lg-8">
    <div class="section-title">
        члены совета
    </div>
    <div class="user-single">
        <div class="user-single__title">
            {{$item->fullName}}
        </div>
        <div class="user-single__info">
            <div class="user-photo">
                <img src="{{ ($item->imageUrl == '') ? '/img/users/photo.jpg' : $item->imageUrl}}" alt="">
            </div>
            <div class="user-description">
                {!! $item->comment_ru !!}
            </div>
        </div>
        @if(count($item->events) > 0)
        <div class="user-single__articles">
            <div>
                материалы
            </div>
            <ul>
                @foreach($item->events as $event)
                <li>
                    <a href="/event/{{$event->id}}">{{$event->title_ru}}</a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
@stop