@extends('layouts.default')

@section('content')
<div class="col-12 col-lg-8">
    <div class="event-wrap">
        @foreach($baners_event as $item)
        <article>
            <div class="article-top">
                <div class="article-top__left">
                    <div class="article-img">
                        <a href="/event/{{$item->id}}">
                            <img src="{{$item->imageUrl}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="article-top__right">
                    <div class="article-title">
                        <a href="/event/{{$item->id}}">
                            {{$item->title_ru}}
                        </a>
                    </div>
                    <div class="article-date">
                        {{ date('d-m-y', strtotime($item->created_at)) }}
                    </div>
                </div>
            </div>
            <div class="article-description">
                {!! $item->intro_text_ru !!}
            </div>
            <div class="article-bottom">
                <div class="article-bottom__full">
                    <a href="/event/{{$item->id}}">Читать полностью</a>
                </div>
                <div class="article-bottom__category">
                    @foreach($item->categories as $category)
                    <a href="{{ route('events', $category->id) }}">{{$category->name_ru}}</a>
                    @endforeach
                </div>
            </div>
        </article>
        @endforeach
        @foreach($baners_report as $item)
        <article>
            <div class="article-top">
                <div class="article-top__left">
                    <div class="article-img">
                        <a href="/report/{{$item->id}}">
                            <img src="{{$item->imageUrl}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="article-top__right">
                    <div class="article-title">
                        <a href="/report/{{$item->id}}">
                            {{$item->name_ru}}
                        </a>
                    </div>
                    <div class="article-date">
                        {{ date('d-m-y', strtotime($item->created_at)) }}
                    </div>
                </div>
            </div>
            <div class="article-description">
                {!! $item->intro_text !!}
            </div>
            <div class="article-bottom">
                <div class="article-bottom__full">
                    <a href="/report/{{$item->id}}">Читать полностью</a>
                </div>
            </div>
        </article>
        @endforeach
        @foreach($baners_content as $item)
        <article>
            <div class="article-top">
                <div class="article-top__left">
                    <div class="article-img">
                        <a href="/content/{{$item->id}}">
                            <img src="{{$item->imageUrl}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="article-top__right">
                    <div class="article-title">
                        <a href="/content/{{$item->id}}">
                            {{$item->title_ru}}
                        </a>
                    </div>
                    <div class="article-date">
                        {{ date('d-m-y', strtotime($item->created_at)) }}
                    </div>
                </div>
            </div>
            <div class="article-description">
                {!! $item->text_ru !!}
            </div>
            <div class="article-bottom">
                <div class="article-bottom__full">
                    <a href="/content/{{$item->id}}">Читать полностью</a>
                </div>
            </div>
        </article>
        @endforeach
    </div>
</div>
@stop