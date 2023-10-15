@extends('layouts.default')

@section('content')
<div class="col-12 col-lg-5">
    <div class="section-title">
        Статьи
    </div>
    <div class="single-content">
        <div class="single-date">
            {{ $item->user->fullName }}
        </div>
        <div class="single-title">
            {{$item->title_ru}}
        </div>
        <div class="single-description">
            {!! $item->intro_text_ru !!}
        </div>
        @if($item->attachmentUrl)
        <div class="single-btn">
            <a href="{{$item->attachmentUrl}}" target="_blank">
                скачать
            </a>
        </div>
        @endif
    </div>
</div>
@stop