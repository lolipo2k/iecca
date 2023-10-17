@extends('layouts.default')

@section('content')
<div class="col-12 col-lg-5">
    <div class="section-title">
        главная
    </div>
    <div class="article-wrap">
        @foreach($list->items() as $item)
        <article>
            <div class="article-title">
                <a href="/event/{{$item->id}}">
                    <b>{{ date('d-m-y', strtotime($item->created_at)) }}</b>
                    {{$item->title_ru}}
                </a>
            </div>
        </article>
        @endforeach
        <div class="article-wrap__all">
            <a href="/event/list">
                Все материалы
            </a>
        </div>
    </div>
</div>
@stop