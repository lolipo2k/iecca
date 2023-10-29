@extends('layouts.default')

@section('content')
<div class="col-12 col-lg-8">
    <div class="section-title">
        арктическое обозрение
    </div>
    <div class="arctic-review">
        @foreach($list->items() as $item)
        <div class="arctic-review__item">
            <div class="arctic-photo">
                <img src="{{$item->imageUrl}}" alt="">
            </div>
            <div class="arctic-info">
                <a href="/journal/{{$item->id}}">
                    <div class="arctic-title">
                        {{$item->title_ru}}
                    </div>
                </a>
                <div class="arctic-name">
                    <span>
                        {{ date('d-m-y', strtotime($item->created_at)) }}
                    </span>
                </div>
                <div class="arctic-description">
                    {!! $item->intro_text_ru !!}
                </div>
            </div>
        </div>
        @endforeach
        @if($list->lastPage() > 1)
        <div class="article-pagination">
            @if($list->currentPage() > 1)
            <div class="article-prev">
                <a href="{{ route('journals') }}?page={{$list->currentPage() - 1}}">
                    <img src="/arrow-left.svg" alt="">
                </a>
            </div>
            @endif
            <div class="article-list">
                <ul>
                    @for($i = 1; $i <= min($list->lastPage(), 5); $i++) <a href="{{ route('journals') }}?page={{$i}}">
                            <li class="{{($i == $list->currentPage()) ? 'act' : ''}}"></li>
                        </a>
                        @endfor
                </ul>
            </div>
            @if($list->currentPage() != $list->lastPage())
            <div class="article-next">
                <a href="{{ route('journals') }}?page={{$list->currentPage() + 1}}">
                    <img src="/arrow-right.svg" alt="">
                </a>
            </div>
            @endif
        </div>
        @endif
    </div>
</div>
@stop