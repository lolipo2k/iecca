@extends('layouts.default')

@section('content')
<div class="col-12 col-lg-8">
    <div class="section-title">
        арктическое обозрение
    </div>
    <div class="single-content">
        <div class="single-date">
            {{ date('d-m-y h:i', strtotime($item->created_at)) }}
        </div>
        <div class="single-title">
            {{$item->title_ru}}
        </div>
        <div class="single-rating" data-type="journal" data-id="{{$item->id}}">
            Оцените материал
            <div class="single-rating__stars act">
                @for ($i = 1; $i <= $item->raiting[0]; $i++)
                    <svg class="set" width="20" height="19" viewBox="0 0 20 19" fill="none" data-id="{{ $i - 1 }}" xmlns="http://www.w3.org/2000/svg">
                        <path id="Star 1" d="M10 1.61804L11.7696 7.06434L11.8819 7.40983H12.2451H17.9717L13.3388 10.7758L13.0449 10.9894L13.1572 11.3348L14.9268 16.7812L10.2939 13.4152L10 13.2016L9.70611 13.4152L5.0732 16.7812L6.84282 11.3348L6.95507 10.9894L6.66118 10.7758L2.02828 7.40983H7.75486H8.11813L8.23039 7.06434L10 1.61804Z" stroke="#0D3D60" />
                    </svg>
                    @endfor
                    @for ($i = 0; $i <= 5; $i++) @if($i <=$item->raiting[0])
                        @continue
                        @endif
                        <svg width="20" height="19" viewBox="0 0 20 19" fill="none" data-id="{{ $i - 1 }}" xmlns="http://www.w3.org/2000/svg">
                            <path id="Star 1" d="M10 1.61804L11.7696 7.06434L11.8819 7.40983H12.2451H17.9717L13.3388 10.7758L13.0449 10.9894L13.1572 11.3348L14.9268 16.7812L10.2939 13.4152L10 13.2016L9.70611 13.4152L5.0732 16.7812L6.84282 11.3348L6.95507 10.9894L6.66118 10.7758L2.02828 7.40983H7.75486H8.11813L8.23039 7.06434L10 1.61804Z" stroke="#0D3D60" />
                        </svg>
                        @endfor
            </div>
            (<span>{{$item->raiting[1]}}</span> голосов)
        </div>
        <div class="sungle-journal">
            <div class="flip-book-container" src="{{$item->attachmentUrl}}"></div>
        </div>
        <div class="single-description">
            {!! $item->full_text_ru !!}
        </div>
        <div class="single-btn">
            <a href="{{$item->attachmentUrl}}" target="_blank">
                скачать
            </a>
        </div>
        @if(count($item->contents) > 0)
        <div class="single-contents">
            <div class="single-contents__title">
                Статьи по теме:
            </div>
            <ul>
                @foreach($item->contents as $content)
                <li>
                    <a href="/content/{{$content->id}}">
                        {{$content->title_ru}}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="single-bottom">
            <div class="info">
                Прочитано {{$item->count}} раз
            </div>

            <div class="info-auth">
                Авторизуйтесь, чтобы получить возможность оставлять комментарии
            </div>
        </div>
    </div>
</div>
<style>
    .flip-book-container {
        height: 600px;
    }
</style>
<style>
    .single-description ul {
        list-style-type: disc;
        padding-left: 20px;
    }
</style>
@stop
@section('scripts')
<script src="{{asset('/js/html2canvas.min.js')}}"></script>
<script src="{{asset('/js/three.min.js')}}"></script>
<script src="{{asset('/js/pdf.min.js')}}"></script>
<script src="{{asset('/js/3dflipbook.min.js')}}"></script>
@stop