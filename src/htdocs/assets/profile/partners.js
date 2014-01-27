
function partners() {
    $('.b-concurs__partners_arrow-wrap-left').hide();

    // правая нижняя стрелка
    $('.b-concurs__partners_arrow-wrap-right').click(function(e){
        e.preventDefault();
        partners_pos({direct: 'left'});
    });

    // левая нижняя стрелка
    $('.b-concurs__partners_arrow-wrap-left').click(function(e){
        e.preventDefault();
        partners_pos({direct: 'right'});
    });
}

//= прокрутка партнеров
function partners_pos(slide) {
    var back = $('.b-concurs__partners-wrap');
    var value = -(back.width()-1120);
    var pos = back.position().left;

    if (slide.direct == 'left') {
        if (pos - 320 <= value){
            back.css('left', value);
            $('.b-concurs__partners_arrow-wrap-right').hide();
        } else {
            back.css('left', pos-320);
            $('.b-concurs__partners_arrow-wrap-left').show();
        }
    } else {
        if (pos + 320 >= 0){
            back.css('left', 0);
            $('.b-concurs__partners_arrow-wrap-left').hide();
        } else {
            back.css('left', pos+320);
            $('.b-concurs__partners_arrow-wrap-right').show();
        }
    }
}
;
