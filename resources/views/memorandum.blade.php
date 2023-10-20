@extends('layouts.default')

@section('content')
<div class="col-12 col-lg-8">
    <div class="single-content">
        <div class="single-date">
            {{ date('d-m-y h:i', strtotime($item->created_at)) }}
        </div>
        <div class="single-title">
            {{$item->title_ru}}
        </div>
        <div class="single-description">
            {!! $item->text_ru !!}
        </div>
    </div>
</div>
<style>
    .single-description ul {
        list-style-type: disc;
        padding-left: 20px;
    }
</style>
@stop