@extends('layouts.default')

@section('content')
<div class="col-12 col-lg-8">
    <div class="section-title">
        Доклады
    </div>
    <div class="single-content">
        <div class="single-date">
            @if($item->author_name != '')
            {{ $item->author_name }}
            @else
            {{ $item->user->fullName }}
            @endif
        </div>
        <div class="single-title">
            {{$item->name_ru}}
        </div>
        <div class="single-description">
            {!! $item->intro_text !!}
        </div>
        @if($item->imageUrl != '')
        <div class="single-img">
            <img src="{{$item->imageUrl}}" alt="">
        </div>
        @endif
        <div class="single-description">
            {!! $item->full_text !!}
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