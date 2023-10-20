<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('/fonts/osanscondensed.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Home</title>
</head>

<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="header-content__left">
                    <div class="header-subtitle">
                        Международный экспертный совет по сотрудничеству в Арктике <br>
                        The International Expert Council on Cooperation in the Arctic
                    </div>
                    <a href="{{ route('home') }}">
                        <div class="header-title">
                            iecca
                        </div>
                    </a>
                </div>
                <div class="header-content__right">
                    <ul>
                        @if(Auth::check())
                        <li>
                            <a href="/auth/{{ auth()->user()->id }}">
                                {{ auth()->user()->username }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ Auth::logout() }}">Выйти</a>
                        </li>
                        @else
                        <li class="registration-open">
                            <img src="/public/icons/registration.svg" alt="">
                            Регистрация
                        </li>
                        <li class="auth-open">
                            <img src="/public/icons/login.svg" alt="">
                            вход
                        </li>
                        @endif
                        <li class="burger-menu">
                            <img src="/public/icons/burger.svg" alt="">
                        </li>
                        <li>
                            <a href="https://csef.ru/" style="font-weight: 700;">cs</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="mobile-menu">
            <div class="mobile-menu__top burger-menu--close">
                <div class="registration-open">
                    <img src="/public/icons/registration.svg" alt="">
                </div>
                <div class="auth-open burger-menu--close">
                    <img src="/public/icons/login.svg" alt="">
                </div>
                <div class="burger-menu--close">
                    <img src="/public/icons/close.svg" alt="">
                </div>
            </div>

            <ul>
                @if(auth()->check())
                <li href="/auth/{{ auth()->user()->id }}">
                    {{ auth()->user()->username }}
                </li>
                <li>
                    <a href="{{ Auth::logout() }}">Выйти</a>
                </li>
                @endif
                @foreach($statics as $static)
                <li>
                    <a href="/page/{{$static->id}}">{{$static->title_ru}}</a>
                </li>
                @endforeach
                <li>
                    <a href="{{ route('users') }}">Члены Совета</a>
                </li>
                <li>
                    <a href="{{ route('events') }}">мероприятия совета</a>
                </li>
                <li>
                    <a href="{{ route('journals') }}">журнал “арктическое обозрение”</a>
                </li>
            </ul>
        </div>
    </header>
    <nav class="header-menu">
        <div class="container">
            <ul>
                <li>
                    <a href="#">О СОВЕТЕ</a>
                    <div class="second-menu">
                        <div class="container">
                            <ul>
                                @foreach($statics as $static)
                                <li>
                                    <a href="/page/{{$static->id}}">{{$static->title_ru}}</a>
                                </li>
                                @endforeach
                                <li>
                                    <a href="{{ route('users') }}">Члены Совета</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="{{ route('events') }}">мероприятия совета</a>
                </li>
                <li>
                    <a href="{{ route('journals') }}">журнал “арктическое обозрение”</a>
                </li>
            </ul>
        </div>
    </nav>
    <main>
        <div class="container">
            @if(Request::is('/'))
            <div class="main-wrap">
                @foreach($baners_event as $baner)
                <div class="main-baner">
                    <div class="main-baner__background">
                        <img src="{{$baner->imageUrl}}" alt="">
                    </div>
                    <div class="main-baner__content">
                        <div class="baner-title">
                            {{$baner->title_ru}}
                        </div>
                        <div class="baner-description">
                            {!! $baner->intro_text_ru !!}

                            <div class="baner-description__name">
                                {{$baner->user->fullName}}
                            </div>
                        </div>
                        <div class="baner-more">
                            <a href="/event/{{$baner->id}}">
                                ПОДРОБНЕЕ
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                @foreach($baners_report as $baner)
                <div class="main-baner">
                    <div class="main-baner__background">
                        <img src="{{$baner->imageUrl}}" alt="">
                    </div>
                    <div class="main-baner__content">
                        <div class="baner-title">
                            {{$baner->title_ru}}
                        </div>
                        <div class="baner-description">
                            {!! $baner->intro_text_ru !!}

                            <div class="baner-description__name">
                                @if($baner->author_name == '')
                                {{$baner->user->fullName}}
                                @else
                                {{$baner->author_name}}
                                @endif
                            </div>
                        </div>
                        <div class="baner-more">
                            <a href="/report/{{$baner->id}}">
                                ПОДРОБНЕЕ
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                @foreach($baners_content as $baner)
                <div class="main-baner">
                    <div class="main-baner__background">
                        <img src="{{$baner->imageUrl}}" alt="">
                    </div>
                    <div class="main-baner__content">
                        <div class="baner-title">
                            {{$baner->title_ru}}
                        </div>
                        <div class="baner-description">
                            {!! $baner->intro_text_ru !!}

                            <div class="baner-description__name">
                                {{$baner->user->fullName}}
                            </div>
                        </div>
                        <div class="baner-more">
                            <a href="/content/{{$baner->id}}">
                                ПОДРОБНЕЕ
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @if(!empty($preview))
            <a href="/event/{{$preview->id}}" class="baner-description">
                {{$preview->title_ru}}
            </a>
            @endif
            @endif
            <div class="main-content row justify-content-between">
                <div class="col-3 d-none d-lg-block">
                    <div class="section-title">
                        выпуски журнала
                    </div>
                    <div class="journal-list">

                        <div class="journal-slider">
                            <div class="journal-slider__wrap">
                                @foreach ($articles as $item)
                                <div class="journal-item">
                                    <div class="journal-item__img">
                                        <a href="/journal/{{$item->id}}">
                                            <img src="{{$item->imageUrl}}" alt="">
                                        </a>
                                    </div>
                                    <div class="journal-item__title">
                                        <a href="/journal/{{$item->id}}">
                                            {{$item->title_ru}}
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if(!Request::is('/'))
                    <div id="datepicker" class="mt-5"></div>
                    <input type="hidden" id="datepicker_value">

                    <div class="event-content row">
                        @foreach($events as $item)
                        <div class="col-12">
                            <div class="event-item">
                                <a href="{{$item->url}}">
                                    <div class="event-img" style="background-image: url('{{$item->imageUrl}}')">
                                    </div>
                                    <div class="event-title">
                                        {{$item->name}}
                                    </div>
                                    <div class="event-black"></div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @yield('content')
                @if(Request::is('/'))
                <div class="col-3 d-none d-lg-block">
                    <div class="section-title">
                        календарь
                    </div>
                    <div id="datepicker"></div>
                    <input type="hidden" id="datepicker_value">
                </div>
                @endif
            </div>
            @if(Request::is('/'))
            <div class="event-content row">
                @foreach($events as $item)
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="event-item">
                        <a href="{{$item->url}}">
                            <div class="event-img" style="background-image: url('{{$item->imageUrl}}')">
                            </div>
                            <div class="event-title">
                                {{$item->name}}
                            </div>
                            <div class="event-black"></div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="section-title">
                Теги
            </div>
            <div class="tags-list">
                @foreach($tags as $tag)
                <a href="{{ route('events', $tag->id) }}" style="font-size: 18px;">{{$tag->name_ru}}</a>
                @endforeach
            </div>
            <div class="footer-menu row">
                <div class="col-4">
                    <div class="menu-title">
                        Последние мероприятия
                    </div>
                    <ul>
                        @foreach($footer_events as $event)
                        <li>
                            <a href="/event/{{$event->id}}">{{$event->title_ru}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-4">
                    <div class="menu-title">
                        Информация
                    </div>
                    <ul>
                        @foreach($statics as $static)
                        <li>
                            <a href="/page/{{$static->id}}">{{$static->title_ru}}</a>
                        </li>
                        @endforeach
                        <li>
                            <a href="{{ route('users') }}">Члены Совета</a>
                        </li>
                    </ul>
                </div>
                <div class="col-4">
                    <div class="menu-title">
                        НАШИ ПРОЕКТЫ
                    </div>
                    <div class="footer-btn">
                        <a href="https://csef.ru/" style="font-weight: 700;">cs</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="modal modal-auth">
        <div class="modal-content">
            <div class="close">
                <img src="/public/icons/close.svg" alt="">
            </div>
            <div class="section-title">
                Вход
            </div>
            <div class="input-item">
                <label>
                    Логин
                </label>
                <input type="text" class="login">
            </div>
            <div class="input-item">
                <label>
                    Пароль
                </label>
                <input type="password" class="password">
            </div>
            <div class="remember">
                <div class="checkbox-item">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                        Запомнить меня
                    </label>
                </div>
                <div class="forget-password">
                    Забыли пароль?
                </div>
            </div>
            <div class="btn-submit">
                Войти
            </div>
        </div>
    </div>
    <div class="modal modal-forget">
        <div class="modal-content">
            <div class="close">
                <img src="/public/icons/close.svg" alt="">
            </div>
            <div class="section-title">
                Восстановление пароля
            </div>
            <div class="input-item">
                <label>
                    Почта
                </label>
                <input type="text">
            </div>
            <div class="btn-submit">
                Отправить
            </div>
        </div>
    </div>
    <div class="modal modal-registration">
        <div class="modal-content">
            <div class="close">
                <img src="/public/icons/close.svg" alt="">
            </div>
            <div class="section-title">
                Регистрация
            </div>
            <div class="input-item">
                <label>
                    Логин
                </label>
                <input type="text" class="login">
            </div>
            <div class="input-item">
                <label>
                    E-mail
                </label>
                <input type="text" class="mail">
            </div>
            <div class="input-item">
                <label>
                    Пароль
                </label>
                <input type="password" class="password">
            </div>
            <div class="input-item">
                <label>
                    Повторите пароль
                </label>
                <input type="password" class="password-repeat">
            </div>
            <div class="checkbox-choose">
                <div class="checkbox-choose__title">
                    Пол
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" id="w">
                    <label for="w">
                        Женский
                    </label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" id="m">
                    <label for="m">
                        Мужской
                    </label>
                </div>
            </div>
            <div class="btn-submit">
                Зарегистрироваться
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js" integrity="sha512-WNZwVebQjhSxEzwbettGuQgWxbpYdoLf7mH+25A7sfQbbxKeS5SQ9QBf97zOY4nOlwtksgDA/czSTmfj4DUEiQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{asset('/js/script.js')}}"></script>
    @yield('scripts')
</body>

</html>