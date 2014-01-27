




$(document).ready(function(){

    partners();

////    личный кабинет

//    статусы юзера

    $('.b-cabinet__user-button').click(function(e){
        e.preventDefault();

        $('.b-cabinet__user-button').removeClass('b-cabinet__user-button-active');
        $(this).addClass('b-cabinet__user-button-active');
    });


    $('.b-cabinet-drag-and-drop__button').click(function(e){
        e.preventDefault();

        $('.b-cabinet-drag-and-drop__button').removeClass('b-cabinet-drag-and-drop__button_active')
        $(this).addClass('b-cabinet-drag-and-drop__button_active')
    });

    $('.b-cabinet__wall-button').click(function(e){
        e.preventDefault();

        $('.b-cabinet__wall-button').removeClass('b-cabinet__user-button-active');
        $(this).addClass('b-cabinet__user-button-active');
    });

    $('.b-cabinet-wall__chat-contact-list-item').click(function(e){
        e.preventDefault();

        $(this).toggleClass('b-cabinet-wall__chat-contact-list-item_active');
    });



//    кошелек
//    открытие/закрытие кошелька

    $('.b-header__wallet-link').click(function(e){
        e.preventDefault();

        $('.b-cabinet-form-wrap').addClass('b-cabinet-form-wrap_active');
    });
    $('.b-cabinet-form__close').click(function(e){
        e.preventDefault();

        $('.b-cabinet-form-wrap').removeClass('b-cabinet-form-wrap_active');
    });

//    открытие/закрытие купить валюту
    $('#buy').click(function(e){
        e.preventDefault();

        $('.b-cabinet-form-buy__wrap').fadeIn();
    });
    $('.b-cabinet-form-buy__close').click(function(e){
        e.preventDefault();

        $('.b-cabinet-form-buy__wrap').fadeOut();
    });

    //    открытие/закрытие пригласить друга
    $('#transfer').click(function(e){
        e.preventDefault();

        $('.b-cabinet-form-transfer__wrap').fadeIn();
    });
    $('.b-cabinet-form-transfer__close').click(function(e){
        e.preventDefault();

        $('.b-cabinet-form-transfer__wrap').fadeOut();
    });
    //    открытие/закрытие бесплатного пополнения
    $('#free').click(function(e){
        e.preventDefault();

        $('.b-cabinet-form-free__wrap').fadeIn();
    });
    $('.b-cabinet-form-free__close').click(function(e){
        e.preventDefault();

        $('.b-cabinet-form-free__wrap').fadeOut();
    });




//    закрытие стикера
    $('.b-sticker__close').click(function(e){
        e.preventDefault();

        $(this).parent('.b-sticker').fadeOut();
    });

//    повышение позици стикера
    $('.b-sticker').click(function(e){
        e.preventDefault();

        $('.b-sticker').css('z-index', '1')
        $(this).css('z-index', '100')
    });


    //    изменение цвета стикера
    $('.b-stickers-new__color-item').click(function(e){
        e.preventDefault();

        $('.b-stickers-new__color-item').removeClass('b-stickers-new__color-item_active');
        $(this).addClass('b-stickers-new__color-item_active');


        if ($(this).attr("id") == "b-stickers-new__color-item_red") {
            $('#sticker-color').removeClass();
            $('#sticker-color').addClass('b-sticker__red');
        } else {
            if ($(this).attr("id") == "b-stickers-new__color-item_brown") {
                $('#sticker-color').removeClass();
                $('#sticker-color').addClass('b-sticker__brown');
            } else {
                if ($(this).attr("id") == "b-stickers-new__color-item_blue") {
                    $('#sticker-color').removeClass();
                    $('#sticker-color').addClass('b-sticker__blue');
                } else {
                    if ($(this).attr("id") == "b-stickers-new__color-item_orange") {
                        $('#sticker-color').removeClass();
                        $('#sticker-color').addClass('b-sticker__orange');
                    } else {
                        if ($(this).attr("id") == "b-stickers-new__color-item_green") {
                            $('#sticker-color').removeClass();
                            $('#sticker-color').addClass('b-sticker__green');
                        }
                    }
                }
            }

        }
    });


//    открытие/зактытие формы отправки стикеров
    $('.b-header__stiker').click(function(e){
        e.preventDefault();

        $('.b-stickers-new').fadeIn();
    });
    $('.b-stickers-new__close').click(function(e){
        e.preventDefault();

        $('.b-stickers-new').fadeOut();
    });

//    форма выбора друзей в стикере

    $(".chosen-select").chosen({
        width: '100%'
    });

//    слайдер выиграй сегодня

    $(".b-cabinet-win-now__wrap").owlCarousel({
        items : 1,
        itemsDesktop : false,
        itemsDesktopSmall : false,
        itemsTablet: false,
        itemsMobile : false,
        beforeInit: true
    });

    $('#unpaid-form').perfectScrollbar({
        wheelSpeed: 41,
        wheelPropagation: false
    });

//    scrollbar для чата

    $('.b-cabinet__chat-contact-list-wrap').perfectScrollbar({
        wheelSpeed: 74,
        wheelPropagation: true
    });


//= ответить на авитт
    $('.b-cabinet-wall__avitter-avitt-comm-wrap').click(function(e){
        e.preventDefault();

        $('.b-cabinet-wall__avitter-avitt-comm-wrap').removeClass('b-cabinet-wall__avitter-avitt-comm-wrap_active');

        $(this).parent().addClass('b-cabinet-wall__avitter-avitt-comm-wrap_active');
    });




////////////////////////////    drag and drops     ///////////////////////////////////////////////////////////

    $( ".b-cabinet-drop" ).droppable({
        out: function( event, ui ) {
            $('.b-cabinet-drag-and-drop').css('z-index', '999999999');
            $(".b-cabinet-win-now__wrap").data('owlCarousel').reinit({
                items : 3,
                beforeInit: function(){
                    $('.b-cabinet-win-now').css('width', '680px');
                    $('.b-cabinet-win-now').css('margin-right', '0');
                    $('.b-cabinet-win-now__wrap').css('width', '680px');
                }
            });

        },
        over: function( event, ui ) {
            $(".b-cabinet-win-now__wrap").data('owlCarousel').reinit({
                items : 1,
                beforeInit: function(){
                    $('.b-cabinet-win-now').css('width', '235px');
                    $('.b-cabinet-win-now').css('margin-right', '15px');
                    $('.b-cabinet-win-now__wrap').css('width', '225px');
                }
            });

        },
        drop: function( event, ui ) {
            $('.b-cabinet-drag-and-drop').css('z-index', '100');
            $('.b-cabinet-drag-and-drop').css('top', '0');
            $('.b-cabinet-drag-and-drop').css('left', '250px');

        }
    });


    $(".b-cabinet-drag-and-drop__link_move").parent('.b-cabinet-drag-and-drop').css('z-index', "100", "position", "absolute")
    $(".b-cabinet-drag-and-drop__link_move").parent('.b-cabinet-drag-and-drop').css("position", "absolute");
    $(".b-cabinet-drag-and-drop__link_move").parent('.b-cabinet-drag-and-drop').draggable({handle: ".b-cabinet-drag-and-drop__link_move"});


    $('.b-cabinet-drag-and-drop__arrow_left').hide();

    // правая стрелка
    $('.b-cabinet-drag-and-drop__arrow_right').click(function(e){
        e.preventDefault();
        slide_drag_and_drops({direct: 'left'});
    });

    // левая стрелка
    $('.b-cabinet-drag-and-drop__arrow_left').click(function(e){
        e.preventDefault();
        slide_drag_and_drops({direct: 'right'});
    });

    $('.b-cabinet-wall__wrap').hide();

    ////////// изменение меню

    $('.b-cabinet-wall__wrap_wall').show();
    $('.b-cabinet-wall__header-menu-text-wall').parents('.b-cabinet-wall__header-menu-fon').addClass('b-cabinet-wall__header-menu-fon_active');
    $('.b-cabinet-wall__header-active').text('Стена');

    $('.b-cabinet-wall__header-menu-fon').click(function(e){
        e.preventDefault();
        $('.b-cabinet-wall__header-active').text($(this).data('name'));

        $('.b-cabinet-wall__header-menu-fon').removeClass('b-cabinet-wall__header-menu-fon_active');
        $(this).addClass('b-cabinet-wall__header-menu-fon_active');

        $('.b-cabinet-wall__wrap').hide();
        $('.b-cabinet-wall__wrap_'+$(this).data('class')).show();

        if ($(this).hasClass('b-cabinet-wall__header-menu-fon-new')){
            $(this).removeClass('b-cabinet-wall__header-menu-fon-new')
        }
    });


    $('.b-cabinet-wall__photo').click(function(e){
        e.preventDefault();
        $('.b-cabinet-wall__wrap_photo').hide();
        $('.b-cabinet-wall__wrap_photo-ones').show();
    });

    $('.b-cabinet-wall__photo_small').click(function(e){
        e.preventDefault();

        $('.b-photo-popup__overlay').show();
        $('.b-photo-popup').show();
    });

    $('.b-photo-popup__close').click(function(e){
        e.preventDefault();

        $('.b-photo-popup__overlay').hide();
        $('.b-photo-popup').hide();
    });

    ////////////// спонсорство

    $('.b-photo-popup__button').click(function(e){
        e.preventDefault();

        $('.b-photo-popup__sponsor').show();
    });
    $('.b-photo-popup__sponsor-close').click(function(e){
        e.preventDefault();

        $('.b-photo-popup__sponsor').hide();
    });

    ///////////// переключение групп (все/мои)

    $('.b-cabinet-wall__groups').click(function(e){
        e.preventDefault();

        $(this).parent().parent().find('.b-cabinet-wall__groups-my-all').removeClass('b-cabinet-wall__groups-active');
        $(this).parent().addClass('b-cabinet-wall__groups-active');

        if ($('#choice_my').hasClass('b-cabinet-wall__groups-active')){
            $('.b-cabinet-wall__games-genres').show();
            $('.b-cabinet-wall__video-close').addClass('b-cabinet-wall__games-close');
        } else {
            $('.b-cabinet-wall__games-genres').hide();
            $('.b-cabinet-wall__video-close').removeClass('b-cabinet-wall__games-close');
        }
    });


    ///////////// открытие/закрытие окна удаления подарка ///////////////////////////////

    $('.b-cabinet-wall__presents-delete-button').click(function(e){
        e.preventDefault();

        $('.b-cabinet-wall__delete').addClass('b-cabinet-wall__delete_active');
    });


    // удалить видео
    $('.b-cabinet-wall__video-close').click(function(e){
        e.preventDefault();

        $(this).parent().hide();
    });

    // удалить игру
    $('.b-cabinet-wall__games-close').click(function(e){
        e.preventDefault();

        $(this).parent().parent().hide();
    });


    $('.b-cabinet-wall__delete-close').click(function(e){
        e.preventDefault();

        $(this).parent().removeClass('b-cabinet-wall__delete_active');
    });


    ///////////////////////////// my friends

    $('#my-friends_all').click(function(e){
        e.preventDefault();

        $('.b-my-friends__cover').fadeIn();
    });

    $('.b-my-friends__wrap').perfectScrollbar({
        wheelSpeed: 70,
        wheelPropagation: false
    });

    $('.b-my-friends__close').click(function(e){
        e.preventDefault();

        $('.b-my-friends__cover').fadeOut();
    });


//  слайдер
    $('.b-participants__arrow_top').hide();

// верхняя стрелка
    $('.b-participants__arrow_top').click(function(e){
        e.preventDefault();
        participants({direct: 'bottom'});
    });

// нижняя стрелка
    $('.b-participants__arrow_bottom').click(function(e){
        e.preventDefault();
        participants({direct: 'top'});
    });

    $('#my-friends_online').click(function(e){
        e.preventDefault();

        $('.b-participants__slider').css('display', 'block');
        $('.b-participants__new-wrap').css('display', 'none');
    });

    $('#my-friends_new').click(function(e){
        e.preventDefault();

        $('.b-participants__slider').css('display', 'none');
        $('.b-participants__new-wrap').css('display', 'block');
    });

    $('.b-participants__new-wrap').perfectScrollbar({
        wheelSpeed: 70,
        wheelPropagation: false
    });


    ///////////////////////////// сообщения

    $('.b-header__email').click(function(e){
        e.preventDefault();

        $('.b-newest').fadeIn();
    });

    $('.b-newest__close').click(function(e){
        e.preventDefault();

        $('.b-newest').fadeOut();
    });

    ///////////////////////////// ещё новости

    $('.b-cabinet-news-line__more').click(function(e){
        e.preventDefault();

        $('.b-news__cover').fadeIn();
    });

    $('.b-news__close').click(function(e){
        e.preventDefault();

        $('.b-news__cover').fadeOut();
    });

    $('.b-news__wrap').perfectScrollbar({
        wheelSpeed: 100,
        wheelPropagation: false
    });

    ///////////////////////////// подарить подарок

    $('.b-header__present').click(function(e){
        e.preventDefault();

        $('.b-present__cover').fadeIn();
    });

    $('.b-present__close').click(function(e){
        e.preventDefault();

        $('.b-present__cover').fadeOut();
    });

    $('.b-present__wrap').perfectScrollbar({
        wheelSpeed: 100,
        wheelPropagation: false
    });


    $('.b-present__item').click(function(e){
        e.preventDefault();

        $('.b-present-new__cover').fadeIn();
    });

    $('.b-present-new__close').click(function(e){
        e.preventDefault();

        $('.b-present-new__cover').fadeOut();
    });


    ///////////////////////////// голосование

    $('.b-cabinet-vote__button').click(function(e){
        e.preventDefault();

        $('.b-cabinet-vote__wrap').css('display', 'none');
        $('.b-cabinet-vote__button').css('display', 'none');
        $('.b-cabinet-vote__done').css('display', 'block');
    });


    ///////////////////////////// музыка
    ////////////////// плейлист

    $('.select').ikSelect();
});


function participants(slide) {
    var back = $('.b-participants__wrap');
    var value = -(back.height()-222);
    var pos = back.position().top;

    if (slide.direct == 'top') {
        if (pos - 148 <= value){
            back.css('top', value);
            $('.b-participants__arrow_bottom').hide();
        } else {
            back.css('top', pos-148);
            $('.b-participants__arrow_top').show();
        }
    } else {
        if (pos + 148 >= 0){
            back.css('top', 0);
            $('.b-participants__arrow_top').hide();
        } else {
            back.css('top', pos+148);
            $('.b-participants__arrow_bottom').show();
        }
    }
}

// прокрутка drag and drops
function slide_drag_and_drops(slide) {
    var back = $('.b-cabinet-drag-and-drop__cover');
    var value = -(back.width()-346);
    var pos = back.position().left;

    if (slide.direct == 'left') {
        if (pos - 346 <= value){
            back.css('left', value);
            $('.b-cabinet-drag-and-drop__arrow_right').hide();
        } else {
            back.css('left', pos-346);
            $('.b-cabinet-drag-and-drop__arrow_left').show();
        }
    } else {
        if (pos + 346 >= 0){
            back.css('left', 0);
            $('.b-cabinet-drag-and-drop__arrow_left').hide();
        } else {
            back.css('left', pos+346);
            $('.b-cabinet-drag-and-drop__arrow_right').show();
        }
    }
}
;
