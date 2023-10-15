$(document).ready(function () {
    $.datepicker.regional['ru'] = {
        closeText: 'Закрыть',
        prevText: 'Предыдущий',
        nextText: 'Следующий',
        currentText: 'Сегодня',
        monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
        monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
        dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
        dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
        dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
        weekHeader: 'Не',
        dateFormat: 'dd.mm.yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['ru']);
    $("#datepicker").datepicker({
        onSelect: function (date) {
            $('#datepicker_value').val(date)
        }
    });
    $("#datepicker").datepicker("setDate", $('#datepicker_value').val());

    $('.journal-slider__wrap').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        prevArrow: "<button type='button' class='slick-prev pull-left'><img src='/icons/arrow-left.svg'></button>",
        nextArrow: "<button type='button' class='slick-next pull-right'><img src='/icons/arrow-right.svg'></button>"
    });

    $('.single-photo__wrap').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        prevArrow: "<button type='button' class='slick-prev pull-left'><svg width='50' height='50' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M11.6665 15L6.6665 10L11.6665 5L12.8332 6.16667L8.99984 10L12.8332 13.8333L11.6665 15Z' fill='#F5F5F5'/></svg></button>",
        nextArrow: "<button type='button' class='slick-next pull-right'><svg width='50' height='50' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M7.83317 15L6.6665 13.8333L10.4998 10L6.6665 6.16667L7.83317 5L12.8332 10L7.83317 15Z' fill='#F5F5F5'/></svg></button>"
    });

    $(".auth-open").click(function () {
        $(".modal-auth").addClass('act');
    });


    $(".registration-open").click(function () {
        $(".modal-registration").addClass('act');
    });

    $(".forget-password").click(function () {
        $(".modal-auth").removeClass('act');
        $(".modal-forget").addClass('act');
    });

    $(".modal-content .close").click(function () {
        $(this).parent().parent().removeClass('act');
    });

    $("#m").click(function () {
        $("#w").prop('checked', false);
    });

    $("#w").click(function () {
        $("#m").prop('checked', false);
    });

    $(".single-rating__stars.act svg").hover(
        function () {
            if ($(".single-rating__stars").hasClass('act')) {
                const stars = $(".single-rating__stars svg");
                for (let index = 0; index <= $(this).data('id'); index++) {
                    $(stars[index]).addClass('act');
                }
            }
        }, function () {
            if ($(".single-rating__stars").hasClass('act')) $(".single-rating__stars svg").removeClass('act');
        }
    );

    $(".single-rating__stars.act svg").click(function () {
        if ($(".single-rating__stars").hasClass('act')) {
            const stars = $(".single-rating__stars svg");
            for (let index = 0; index <= $(this).data('id'); index++) {
                $(stars[index]).addClass('act');
            }
            $(".single-rating__stars").removeClass('act');

            const singleRaiting = $(".single-rating");

            const id = singleRaiting.data('id');
            const type = singleRaiting.data('type');

            singleRaiting.find('span').text(Number(singleRaiting.find('span').text()) + 1)

            $.ajax({
                url: '/set-raiting',
                type: 'post',
                data: `id=${id}&type=${type}&raiting=${$(this).data('id') + 1}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }
    });
    /*
        $(".report-full").click(function () {
            $(this).parent().find('.report-description').find('div').toggleClass('disbl');
            $(this).parent().toggleClass('full');
    
            $(this).parent().find('.report-full').toggleClass('disbl');
        }); */

    $(".burger-menu").click(function () {
        $(".mobile-menu").addClass('act');
    });
    $(".burger-menu--close").click(function () {
        $(".mobile-menu").removeClass('act');
    });

    $(".modal-registration .btn-submit").click(function () {
        const login = $(".modal-registration .login").val();
        const mail = $(".modal-registration .mail").val();
        const password = $(".modal-registration .password").val();
        const repeat = $(".modal-registration .password-repeat").val();
        const sex = ($("#m").prop('checked') == true) ? 1 : 0;

        $.ajax({
            url: '/register',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: `username=${login}&email=${mail}&password=${password}&repeat=${repeat}&sex=${sex}`,
        }).then(function () {
            location.reload();
        });
    });

    $(".modal-auth .btn-submit").click(function () {
        const login = $(".modal-auth .login").val();
        const password = $(".modal-auth .password").val();

        $.ajax({
            url: '/auth',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: `username=${login}&password=${password}`,
        }).then(function () {
            location.reload();
        });
    });
});