@extends('layouts.default')

@section('content')
<div class="col-12 col-lg-5">
    <div class="section-title">
        главная
    </div>
    <div class="article-wrap">
        @foreach($list->items() as $item)
        <article>
            <div class="article-img">
                <a href="/event/{{$item->id}}">
                    <img src="{{$item->imageUrl}}" alt="">
                </a>
            </div>
            <div class="article-title">
                <a href="/event/{{$item->id}}">
                    {{$item->title_ru}}
                </a>
            </div>
            <div class="article-info">
                <div class="article-info__name">
                    {{$item->user->fullName}}
                </div>
                <div class="article-info__date">
                    {{ date('d-m-y', strtotime($item->created_at)) }}
                </div>
            </div>
            <div class="article-description">
                {!! $item->intro_text_ru !!}
            </div>
            <div class="article-link">
                <a href="{{ route('events', $item->category->id) }}">
                    {{$item->category->name_ru}}
                </a>
            </div>
        </article>
        @endforeach
        @if($list->lastPage() > 1)
        <div class="article-pagination">
            @if($list->currentPage() > 1)
            <div class="article-prev">
                <a href="?page={{$list->currentPage() - 1}}">
                    <img src="/icons/arrow-left.svg" alt="">
                </a>
            </div>
            @endif
            <div class="article-list">
                <ul>
                    @for($i = 1; $i <= min($list->lastPage(), 5); $i++) <a href="?page={{$i}}">
                            <li class="{{($i == $list->currentPage()) ? 'act' : ''}}"></li>
                        </a>
                        @endfor
                </ul>
            </div>
            @if($list->currentPage() != $list->lastPage())
            <div class="article-next">
                <a href="?page={{$list->currentPage() + 1}}">
                    <img src="/icons/arrow-right.svg" alt="">
                </a>
            </div>
            @endif
        </div>
        @endif
    </div>
</div>
@stop