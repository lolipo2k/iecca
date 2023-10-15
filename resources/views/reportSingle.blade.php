@extends('layouts.default')

@section('content')
<div class="col-12 col-lg-8">
    <div class="section-title">
        Доклады
    </div>
    <div class="single-content">
        <div class="single-date">
            {{ $item->user->fullName }}
        </div>
        <div class="single-title">
            {{$item->name_ru}}
        </div>
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
@stop