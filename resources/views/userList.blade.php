@extends('layouts.default')

@section('content')
<div class="col-12 col-lg-8">
    <div class="section-title">
        члены совета
    </div>
    <div class="users-list">
        @foreach($list->items() as $item)
        <div class="users-list__item">
            <div class="user-photo">
                <img src="{{ ($item->imageUrl == '') ? '/img/users/photo.jpg' : $item->imageUrl}}" alt="">
            </div>
            <div class="user-info">
                <div class="user-info__title">
                    {{$item->fullName}}
                </div>
                <div class="user-info__description">
                    {!! $item->shortDescription !!}
                </div>
            </div>
            <div class="user-link">
                <a href="/user/{{ $item->id }}">Посмотреть профиль</a>
            </div>
        </div>
        @endforeach
        @if($list->lastPage() > 1)
        <div class="article-pagination">
            @if($list->currentPage() > 1)
            <div class="article-prev">
                <a href="{{ route('users') }}?page={{$list->currentPage() - 1}}">
                    <img src="/icons/arrow-left.svg" alt="">
                </a>
            </div>
            @endif
            <div class="article-list">
                <ul>
                    @for($i = 1; $i <= min($list->lastPage(), 5); $i++) <a href="{{ route('users') }}?page={{$i}}">
                            <li class="{{($i == $list->currentPage()) ? 'act' : ''}}"></li>
                        </a>
                        @endfor
                </ul>
            </div>
            @if($list->currentPage() != $list->lastPage())
            <div class="article-next">
                <a href="{{ route('users') }}?page={{$list->currentPage() + 1}}">
                    <img src="/icons/arrow-right.svg" alt="">
                </a>
            </div>
            @endif
        </div>
        @endif
    </div>
</div>
@stop