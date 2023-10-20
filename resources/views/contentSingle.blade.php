@extends('layouts.default')

@section('content')
<div class="col-12 col-lg-8">
    <div class="section-title">
        Статьи
    </div>
    <div class="single-content">
        <div class="single-date">
            {{ date('d-m-y h:i', strtotime($item->created_at)) }}
        </div>
        <div class="single-date">
            @if($baner->author_name == '')
            {{$baner->user->fullName}}
            @else
            {{$baner->author_name}}
            @endif
        </div>
        <div class="single-title">
            {{$item->title_ru}}
        </div>
        <div class="single-description intro">
            {!! $item->text_ru !!}
        </div>
        <div class="single-img">
            <img src="{{$item->imageUrl}}" alt="">
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
<style>
    .single-description ul {
        list-style-type: disc;
        padding-left: 20px;
    }
</style>
@stop