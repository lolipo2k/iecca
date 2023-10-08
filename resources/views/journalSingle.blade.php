@extends('layouts.default')

@section('content')
<div class="col-5">
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
        <div class="single-rating">
            Оцените материал
            <div class="single-rating__stars act">
                <svg class="set" width="20" height="19" viewBox="0 0 20 19" fill="none" data-id="0" xmlns="http://www.w3.org/2000/svg">
                    <path id="Star 1" d="M10 1.61804L11.7696 7.06434L11.8819 7.40983H12.2451H17.9717L13.3388 10.7758L13.0449 10.9894L13.1572 11.3348L14.9268 16.7812L10.2939 13.4152L10 13.2016L9.70611 13.4152L5.0732 16.7812L6.84282 11.3348L6.95507 10.9894L6.66118 10.7758L2.02828 7.40983H7.75486H8.11813L8.23039 7.06434L10 1.61804Z" stroke="#0D3D60" />
                </svg>
                <svg width="20" height="19" viewBox="0 0 20 19" fill="none" data-id="1" xmlns="http://www.w3.org/2000/svg">
                    <path id="Star 1" d="M10 1.61804L11.7696 7.06434L11.8819 7.40983H12.2451H17.9717L13.3388 10.7758L13.0449 10.9894L13.1572 11.3348L14.9268 16.7812L10.2939 13.4152L10 13.2016L9.70611 13.4152L5.0732 16.7812L6.84282 11.3348L6.95507 10.9894L6.66118 10.7758L2.02828 7.40983H7.75486H8.11813L8.23039 7.06434L10 1.61804Z" stroke="#0D3D60" />
                </svg>
                <svg width="20" height="19" viewBox="0 0 20 19" fill="none" data-id="2" xmlns="http://www.w3.org/2000/svg">
                    <path id="Star 1" d="M10 1.61804L11.7696 7.06434L11.8819 7.40983H12.2451H17.9717L13.3388 10.7758L13.0449 10.9894L13.1572 11.3348L14.9268 16.7812L10.2939 13.4152L10 13.2016L9.70611 13.4152L5.0732 16.7812L6.84282 11.3348L6.95507 10.9894L6.66118 10.7758L2.02828 7.40983H7.75486H8.11813L8.23039 7.06434L10 1.61804Z" stroke="#0D3D60" />
                </svg>
                <svg width="20" height="19" viewBox="0 0 20 19" fill="none" data-id="3" xmlns="http://www.w3.org/2000/svg">
                    <path id="Star 1" d="M10 1.61804L11.7696 7.06434L11.8819 7.40983H12.2451H17.9717L13.3388 10.7758L13.0449 10.9894L13.1572 11.3348L14.9268 16.7812L10.2939 13.4152L10 13.2016L9.70611 13.4152L5.0732 16.7812L6.84282 11.3348L6.95507 10.9894L6.66118 10.7758L2.02828 7.40983H7.75486H8.11813L8.23039 7.06434L10 1.61804Z" stroke="#0D3D60" />
                </svg>
                <svg width="20" height="19" viewBox="0 0 20 19" fill="none" data-id="4" xmlns="http://www.w3.org/2000/svg">
                    <path id="Star 1" d="M10 1.61804L11.7696 7.06434L11.8819 7.40983H12.2451H17.9717L13.3388 10.7758L13.0449 10.9894L13.1572 11.3348L14.9268 16.7812L10.2939 13.4152L10 13.2016L9.70611 13.4152L5.0732 16.7812L6.84282 11.3348L6.95507 10.9894L6.66118 10.7758L2.02828 7.40983H7.75486H8.11813L8.23039 7.06434L10 1.61804Z" stroke="#0D3D60" />
                </svg>
            </div>
            (2 голосов)
        </div>
        <div class="single-img">
            <img src="{{$item->imageUrl}}" alt="">
        </div>
        <div class="single-description">
            {!! $item->full_text_ru !!}
        </div>
        <div class="single-btn">
            <a href="{{$item->attachmentUrl}}" target="_blank">
                скачать
            </a>
        </div>
        <div class="single-bottom">
            <div class="info">
                Прочитано {{$item->count}} раз
            </div>
            <div class="info">
                Опубликовано в <a href="{{ route('journals', $item->direction->id) }}">{{$item->direction->name_ru}}</a>
            </div>

            <div class="info-auth">
                Авторизуйтесь, чтобы получить возможность оставлять комментарии
            </div>
        </div>
    </div>
</div>
@stop