@extends('layouts.default')

@section('content')
<div class="col-12 col-lg-8">
    <div class="section-title">
        мероприятия
    </div>
    <div class="event-wrap">
        @foreach($list->items() as $item)
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
        @if($list->lastPage() > 1)
        <div class="article-pagination">
            @if($list->currentPage() > 1)
            <div class="article-prev">
                <a href="{{ route('events') }}?page={{$list->currentPage() - 1}}">
                    <img src="/icons/arrow-left.svg" alt="">
                </a>
            </div>
            @endif
            <div class="article-list">
                <ul>
                    @for($i = 1; $i <= min($list->lastPage(), 5); $i++) <a href="{{ route('events') }}?page={{$i}}">
                            <li class="{{($i == $list->currentPage()) ? 'act' : ''}}"></li>
                        </a>
                        @endfor
                </ul>
            </div>
            @if($list->currentPage() != $list->lastPage())
            <div class="article-next">
                <a href="{{ route('events') }}?page={{$list->currentPage() + 1}}">
                    <img src="/icons/arrow-right.svg" alt="">
                </a>
            </div>
            @endif
        </div>
        @endif
    </div>
</div>
@stop