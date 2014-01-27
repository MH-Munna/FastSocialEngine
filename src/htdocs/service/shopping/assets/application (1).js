// This is a manifest file that'll be compiled into application.js, which will include all the files
// listed below.
//
// Any JavaScript/Coffee file within this directory, lib/assets/javascripts, vendor/assets/javascripts,
// or vendor/assets/javascripts of plugins, if any, can be referenced here using a relative path.
//
// It's not advisable to add code directly here, but if you do, it'll appear at the bottom of the
// compiled file.
//
// Read Sprockets README (https://github.com/sstephenson/sprockets#sprockets-directives) for details
// about supported directives.
//




$(document).ready(function(){

    //= переключение страниц
    $('.b-pages__page').click(function(e){
        e.preventDefault();
        $('.b-pages__page').removeClass('b-pages__page_active');
        $(this).addClass('b-pages__page_active');
    });

    $('.b-product__button-discover').click(function(e){
        e.preventDefault();
        $(this).parent('.b-product__button-wrap').toggleClass('b-product__button-wrap_active');
    });

    //= скролл со слайдера на товар
    $('.b-scroll').click(function(e){ e.preventDefault();
        var self = $(this);
        var target = $(this).data('target');

        $('body').animate({'scrollTop': $(target).offset().top}, 700, 'swing', function() { window.location.hash = self.attr('href');
        });
    });


    $('.b-sliders-top__arrow-wrap_left').hide();
    $('.b-sliders-top__cover_shadow-left-active').hide();

    //= правая верхняя стрелка
    $('.b-sliders-top__arrow-wrap_right').click(function(e){
        e.preventDefault();
        back_pos({direct: 'left'});
    });

    //= левая верхняя стрелка
    $('.b-sliders-top__arrow-wrap_left').click(function(e){
        e.preventDefault();
        back_pos({direct: 'right'});
    });




    $('.b-sliders-bottom__arrow_left').hide();

    //= правая нижняя стрелка
    $('.b-sliders-bottom__arrow_right').click(function(e){
        e.preventDefault();
        bottom_pos({direct: 'left'});
    });

    //= левая нижняя стрелка
    $('.b-sliders-bottom__arrow_left').click(function(e){
        e.preventDefault();
        bottom_pos({direct: 'right'});
    });


    //= groups: изменение кнопки показать\скрыть комментарии
    $('.b-post__button').click(function(e){
        e.preventDefault();

        $(this).toggleClass('b-post__button_active');

    });


    //= кнопка оставить заявку
    $('.b-product-bid__button').click(function(e){
        e.preventDefault();
        $(this).addClass('b-product-bid__none');
    });


    //= переключение меню в группе
    $('.b-wall-menu__menu').click(function(e){
        e.preventDefault();

        $('.b-wall-menu__menu').removeClass('b-wall-menu__menu_active');

        $(this).addClass('b-wall-menu__menu_active');
    });


    //= изменение картинок нанижнем слайдере
    $('.b-slide-bottom').click(function(e){
        e.preventDefault();

        var bottom_img = $(this).data('bottom_img');

        // удаление класса active
        $('.b-slide-bottom').removeClass('b-slide-bottom_phone-active');
        $('.b-slide-bottom').removeClass('b-slide-bottom_ipad-active');
        $('.b-slide-bottom').removeClass('b-slide-bottom_pc-active');
        $('.b-slide-bottom').removeClass('b-slide-bottom_tv-active');

        // добавление класса active
        if (bottom_img == 'phone')  {
            $(this).addClass('b-slide-bottom_phone-active');
        } else if (bottom_img == 'ipad')  {
            $(this).addClass('b-slide-bottom_ipad-active');
        } else if (bottom_img == 'pc') {
            $(this).addClass('b-slide-bottom_pc-active');
        } else if (bottom_img == 'tv') {
            $(this).addClass('b-slide-bottom_tv-active');
        }

        $('.b-slide-bottom__wrap').removeClass('b-slide-bottom__wrap_active');
        $('.b-slide-bottom').removeClass('b-slide-bottom_active');
        $(this).parent('.b-slide-bottom__wrap').addClass('b-slide-bottom__wrap_active');
        $(this).addClass('b-slide-bottom_active');
    });
});

//= прокрутка верхнего слайдера
function back_pos(slide) {
    var back = $('.b-sliders-top__wrap');
    var value = -(back.width()-1140);
    var pos = back.position().left;

    if (slide.direct == 'left') {
        if (pos - 480 <= value){
            back.css('left', value);
            $('.b-sliders-top__arrow-wrap_right').hide();
            $('.b-sliders-top__cover_shadow-right-active').hide();
            $('.b-sliders-top__cover_shadow-left-active').show();
        } else {
            back.css('left', pos-480);
            $('.b-sliders-top__arrow-wrap_left').show();
        }
    } else {
        if (pos + 480 >= 0){
            back.css('left', 0);
            $('.b-sliders-top__arrow-wrap_left').hide();
            $('.b-sliders-top__cover_shadow-left-active').hide();
            $('.b-sliders-top__cover_shadow-right-active').show();
        } else {
            back.css('left', pos+480);
            $('.b-sliders-top__arrow-wrap_right').show();
        }
    }
}

//= прокрутка нижнего слайдера
function bottom_pos(slide) {
    var back = $('.b-sliders-bottom__wrap');
    var value = -(back.width()-980);
    var pos = back.position().left;

    if (slide.direct == 'left') {
        if (pos - 140 <= value){
            back.css('left', value);
            $('.b-sliders-bottom__arrow_right').hide();
        } else {
            back.css('left', pos-140);
            $('.b-sliders-bottom__arrow_left').show();
        }
    } else {
        if (pos + 140 >= 0){
            back.css('left', 0);
            $('.b-sliders-bottom__arrow_left').hide();
        } else {
            back.css('left', pos+140);
            $('.b-sliders-bottom__arrow_right').show();
        }
    }
}
;
