/**
 * обо всех найденных ошибках и уязвимостях просьба сообщать на dev@avatoria.com
 */

//var lastEventId;
var myUpdatesID;
var viewProfileID;
var activeDialogId;
var activeTab;
var base_site_url;

$(document).ready(function(){
    // для выхова не через 5 сек после загрузки страницы а сразу (единовременно) потом переделаю на Comet
    myUpdates();
    window.myUpdatesID = setInterval(myUpdates, 5000);
    $(".modal").colorbox();
});

window.addEventListener("popstate", function(e) {
    //alert(location.pathname);
}, false)

function myUpdates(){
        $.ajax({
            type: "POST",
            url: '/ajax/get_new_events.php',
            dataType: 'json',
            data: {getEvent: window.lastEventId}
        }).success(
            function (msg){
                if (msg.dialog_id == window.activeDialogId){
                    if (window.activeTab == 'chat'){
                        msg.v = 0;
                    }
                    dialog_update_message_list(msg.dialog_id);
                }
                window.lastEventId = msg.nextEventID;
                if (msg.v==1){
                showNotification({
                    type: 'information',
                    text: msg.info
                    });
                if (msg.billets){display_billets(msg.billets);}
                }
            });
        return true;
}

/**
 * Данный метод открывает профиль заданного пользователя
 * как можно скорее необходимо ее переписать не на полную перезагрузку а загрузку всего интерфейса аяксом
 * @param uid
 * @returns {boolean}
 */
function open_profile(uid){
    window.location.replace(window.base_site_url+'/profile/'+uid);
    return false;
}

function click_to_load_main_avatar(){
    if (window.myProfileID == window.viewProfileID){
        document.getElementById('upload_avatar').click();
    }
    return false;
}

function load_main_avatar(){
    $.ajax({
        type: "POST",
        url: '/ajax/get_avatar.php',
        dataType: 'json',
        data: {uid: window.viewProfileID}
    }).success(
            function (msg){
                $('#opened_profile_main_avatar').attr('src', msg.avatar_url_233x233);
                $('#opened_profile_main_avatar').fadeTo('slow', 1);
            }
        )
}

/**
 * Вызов всплывашки =)
 * @param options
 */
function showNotification(options) {
    var n = noty({
        text: options.text,
        type: options.type,
        dismissQueue: true,
        layout: 'bottomLeft',
        theme: 'defaultTheme'
    });
    console.log('html: '+n.options.id);
}

/**
 * Обновить показатели кошелька
 * @param billets_count
 * @returns {boolean}
 */
function display_billets(billets_count){
    $('#display_billets').text(billets_count);
    return true;
}


//function pay_invoice(invoiceID){
//    $.ajax({
//        type: "POST",
//        url: '/ajax/pay_invoice.php',
//        dataType: 'json',
//        data: {invoiceID: invoiceID}
//    }).success(
//        function (msg){
//            if (msg.result=='ok'){
//                alert('оплачено');
//            }
//        }
//    )
//}

/**
 * Открытие диалога настроек пользователя
 */
function get_my_config(){
    $.colorbox({href: '/ajax_html/get_my_config.php', width: 650, height: 400, data: {}});
}

/**
 * Получить список заявок в друзья
 */
function get_requestes(){
    $.colorbox({href: '/ajax_html/requestes_to_friend.php', width: 650, height: 400, data: {}});
}

/**
 * Обновить кнопку "добавления в друзья"
 */
function update_add_friend_button(){
    $('#button_add_friends').load('/ajax_html/button_add_friend.php', {profile: window.viewProfileID});
}

/**
 * Добавление в друзья второй параметр не обязателен (используется исключительно для скрытия самой заявки на добавление в списке друзей)
 * @param uid
 * @param element
 */
function add_friend(uid, element){
    $.ajax({
        type: "POST",
        url: '/ajax/friendship.php',
        data: {user_id: uid, action: 'add'}
    }).success(
        function (msg){
            if (msg.result=='ok'){
                alert('ok');
            }
            //update_add_friend_button();
            if (element){
                $('#'+element).hide();
            }
        }
    )
}

/**
 * Удалить из друзей
 */
function del_friend(){
    $.ajax({
        type: "POST",
        url: '/ajax/friendship.php',
        data: {user_id: window.viewProfileID, action: 'del'}
    }).success(
        function (msg){
            if (msg.result=='ok'){
                alert('ok');
            }
            update_add_friend_button();
        }
    )
}

/**
 * Открыть результаты поиска
 */
function search_dialog(){
    $.colorbox({href: '/ajax_html/search.php', width: 650, height: 400, data: {query: $('#query_search_text').val()}});
}

/**
 * Запустить основную игру (в нашем случае мус и пус)
 */
function start_main_game(){
 $('#main_game').height(540);
 $('#main_game').load('/ajax_html/app_start.php', {app_id: 48, width: 1258, height: 540});
}

/**
 * Стартует диалог с пользователем
 * @param uid
 */
function dialog_start(uid){
    $.ajax({
        type: "POST",
        url: '/ajax/dialog/actions.php',
        data: {uid: uid, action: 'dialog_start'}
    }).success(
        function (msg){
            $('#chat_tab_dialog_list').load('/ajax_html/dialog/index.php', {action: 'chat_tab_dialog_list_update'});
        }
    )
}

function dialog_get_all(){
    $.ajax({
        type: "POST",
        url: '/ajax/dialog/actions.php',
        data: {action: 'dialog_get_all'}
    }).success(
        function (msg){
        }
    )
}

function message_add(message, dialog_id){
    $.ajax({
        type: "POST",
        url: '/ajax/dialog/actions.php',
        data: {action: 'message_add', message: message, dialog_id: dialog_id}
    }).success(
        function (msg){
            dialog_update_message_list(dialog_id);
        }
    )
}

function message_get_after(message_id, dialog_id){
    $.ajax({
        type: "POST",
        url: '/ajax/dialog/actions.php',
        data: {action: 'message_get_after', message_id: message_id, dialog_id: dialog_id}
    }).success(
        function (msg){
        }
    )
}

function dialog_update_message_list(dialog_id){
    window.activeDialogId = dialog_id;
    $('#chat_tab_messages_list').load('/ajax_html/dialog/index.php', {dialog_id: dialog_id, action: 'dialog_update_message_list'});
}

function chat_tab_send_click(element, dialog_id){
    element = CKEDITOR.instances[element];
    message_add(element.getData(), dialog_id);
    element.setData('');
}

/**
 * Открытие кошелька
 */
function open_cache_form(){
    $('#cache_box').load('/ajax_html/get_my_cache.php');
    $('.b-cabinet-form-wrap').addClass('b-cabinet-form-wrap_active');
    return false;
}

/**
 * Закрытие формы кошелька
 * @returns {boolean}
 */
function close_cache_form(){
    $('.b-cabinet-form-wrap').removeClass('b-cabinet-form-wrap_active');
    return false;
}

/**
 * Добавляет комментарий к объекту
 * @param id
 * @param type
 * @param parent
 */
function add_comment(id,type){
    $.ajax({
        type: "POST",
        url: '/ajax/comments.php',
        dataType: 'json',
        data: {
            action: 'add_comment',
            id:id,
            type:type,
            text:$('#comment_'+type+'_'+id).val()
        }
    }).success(
        function (msg){
            $('#comment_'+type+'_'+id).val('');
            if (msg.id){
                insert_comm(type, id, msg.id);
            }
        }
    )
}

/**
 * Подгрузка комментария
 * @param type
 * @param id
 * @param commentID
 * @returns {boolean}
 */
function insert_comm(type, id, commentID){
    $.ajax({
        type: "POST",
        url: '/ajax_html/comments_html.php',
        data: { action: 'get_comment', commentId: commentID }
    }).success(
        function(msg){
            $('#'+type+'_'+id+'_container').prepend(msg);
        });
    return true;
}

/**
 * Удаление комментария
 * @param id
 * @returns {boolean}
 */
function delete_comment(id){
    if (confirm('Удалить запись?')){
    $.ajax({
        type: "POST",
        url: '/ajax/comments.php',
        dataType: 'json',
        data: {
            action: 'delete_comment',
            id:id
        }
    }).success(
        function (msg){
            if (msg.id){
                $('#wall_'+id).hide();
            }
        }
    )
    }
    return false;
}

/**
 * Открытие формы комментария к комментарию
 * @returns {boolean}
 */
function start_comment_to_coment(commentID){
    //$('.b-cabinet-wall__avitter-avitt-comm-wrap').removeClass('b-cabinet-wall__avitter-avitt-comm-wrap_active');
    $('.b-cabinet-wall__avitter-avitt-comm-wrap_active').removeClass('b-cabinet-wall__avitter-avitt-comm-wrap_active');
    $('#wall_'+commentID).addClass('b-cabinet-wall__avitter-avitt-comm-wrap_active');
    return false;
}

/**
 * Обновляет страницу со списком видеозаписей пользователя
 * @param uid
 * @returns {boolean}
 */
function update_video_list(uid){
    uid = uid || window.viewProfileID;
    $('#videos_box').load('/ajax_html/videos_list.php', { 'uid': uid });

    return false;
}

/**
 * Открывает окно с просмотром видеоролика
 * @param id
 */
function open_video(id){
    $('#photo_popup_box').load('/ajax_html/video_get.php', {'id':id}).show();
    $('.b-photo-popup__overlay').show();
    $('.b-photo-popup').show();
    return false;
}

/**
 * Удаление видео
 * @param id
 * @returns {boolean}
 */
function delete_video(id){
    if (confirm('Удалить видео?')){
        $.ajax({
            type: "POST",
            url: '/ajax/video.php',
            dataType: 'json',
            data: {
                action: 'delete',
                id:id
            }
        }).success(
            function (msg){
                if (msg==0){
                    photo_popup_close();
                    update_video_list(window.viewProfileID);
                }
            }
        )
    }
    return false;
}

/**
 * Открытие формы добавления видеоролика
 * @returns {boolean}
 */
function load_video(){
    $('#photo_popup_box').load('/ajax_html/video_load.php').show();
    $('.b-photo-popup__overlay').show();
    $('.b-photo-popup').show();
    return false;
}

/**
 * Запрашивает дополнительную информацию от ютуба
 * @param idElement
 * @returns {boolean}
 */
function get_video_info_by_url(idElement){
    var strUrl = $('#'+idElement).val();
    $.ajax({
        type: "POST",
        url: '/ajax/video_info_by_url.php',
        dataType: 'json',
        data: {
            videoURL: strUrl
        }
    }).success(
        function (msg){
            if (msg.error>0){
                $('#vi_error').text(msg.error_text);
            }
            if (msg.info){
                $('#vi_name').val(msg.info.title);
                $('#vi_text').val(msg.info.desc);
            }
        }
    )
    return true;
}

/**
 * Открывает диалог редактирования информации о видео
 * @param videoID
 * @returns {boolean}
 */
function edit_video(videoID){
    $('#photo_popup_box').load('/ajax_html/video.php', {'id':videoID, 'action': 'editForm'}).show();
    $('.b-photo-popup__overlay').show();
    $('.b-photo-popup').show();
    return false;
}

function save_video_info(videoID){
    $.ajax({
        type: "POST",
        url: '/ajax/video.php',
        dataType: 'json',
        data: {
            'action': 'editInfo',
            'id': videoID,
            'name': $('#vi_name').val(),
            'description': $('#vi_text').val()
        }
    }).success(
        function (msg){
            if (msg==0) {
                open_video(videoID);
                update_video_list(window.viewProfileID);
            }
        }
    )
    return false;
}

function copy_video(videoID){
    $.ajax({
        type: "POST",
        url: '/ajax/video.php',
        dataType: 'json',
        data: {
            'action': 'copyVideo',
            'id': videoID
        }
    }).success(
        function (msg){
            if (msg.result==0) {
                $('.span_copy_video_'+videoID).text(msg.text);
            }
        }
    )
    return false;
}

function show_mini_info(thisElement, minitabName){
    $('.b-cabinet__user-button').removeClass('b-cabinet__user-button-active');
    $('.b-cabinet__user-city').hide();
    $('.b-cabinet__user-city').filter('.'+minitabName).show();
    $(thisElement).addClass('b-cabinet__user-button-active');
    return false;
}

//GROUPS TAB

/**
 * Данный метод открывает группу
 * @param id
 * @returns {boolean}
 */
function open_group(id){
    window.location.replace(window.base_site_url+'/group/'+id);
    return false;
}

/**
 * Открытие вкладок на вкладке со списком групп
 * @param tabName
 * @returns {boolean}
 */
function groups_list_get_tab(tabName){
    $('#groups_tab_box').load('/ajax_html/groups_list.php', {'action': 'getTab', tabName: tabName}).show();
    return false;
}

/**
 * Создание новой группы
 * @returns {boolean}
 */
function groups_list_create(){
    $.ajax({
        type: "POST",
        url: '/ajax/groups_list.php',
        dataType: 'json',
        data: {
            'action': 'create'
        }
    }).success(
        function (msg){
            open_group(msg);
        }
    )
    return false;
}
//function tab_select(tabId){
//    $('.b-cabinet-wall__header-active').text($(this).data('name'));
//
//    $('.b-cabinet-wall__header-menu-fon').removeClass('b-cabinet-wall__header-menu-fon_active');
//    $(this).addClass('b-cabinet-wall__header-menu-fon_active');
//
//    $('.b-cabinet-wall__wrap').hide();
//    $('.b-cabinet-wall__wrap_'+$(this).data('class')).show();
//
//    if ($(this).hasClass('b-cabinet-wall__header-menu-fon-new')){
//        $(this).removeClass('b-cabinet-wall__header-menu-fon-new')
//    }
//
//    $('.b-cabinet-wall__wrap').hide();
//
//    $('.b-cabinet-wall__wrap_'+tabId).show();
//    $('.b-cabinet-wall__header-menu-text-'+tabId).parents('.b-cabinet-wall__header-menu-fon').addClass('b-cabinet-wall__header-menu-fon_active');
//
//    //$('.b-cabinet-wall__header-menu-fon').preventDefault();
//
//}
//

/**
 * Запускает воспроизведение выбранного трека
 * @param trackID
 * @returns {boolean}
 */
function playAudioTrack(trackID){
    $('.audio-play-button').addClass('b-cabinet-wall__music-icon-play');
    $('#audioTrackID-'+trackID).removeClass('b-cabinet-wall__music-icon-play')
    window.audio.load($('#audioTrackID-'+trackID).attr('data-src'));
    window.audio.play();
    return false;
}

function open_playlist(pl_id, sort){
    $('#opened_playlist').load(
        '/ajax_html/audio.php', {'pl_id':pl_id, 'sort': sort}).show()
    );
    return false;
}
