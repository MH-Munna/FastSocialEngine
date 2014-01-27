/**
 * Создание нового фотоальбома
 */
function create_photo_album(){ //Создает новый альбом у пользователя
    $.ajax({
        type: "POST",
        url: '/ajax/photo_album.php',
        dataType: 'json',
        data: { action: "create_album" }
    }).success(
        function( msg ) {
            open_photo_album(msg.new_album_id);
        });

}

/**
 * Удаление фотоальбома
 * @param id
 */
function del_photo_album(id){
    if (confirm('Уверены, что хотите удалить этот альбом?')){
    id = id || 0;

    $.ajax({
        type: "POST",
        url: '/ajax/photo_album.php',
        dataType: 'json',
        data: { action: "del_photo_album", albumId: id }
    }).success(
        function (msg){
            update_photo_albums_list();
        });
    }

}

/**
 * удаление фотографии
 * @param id
 */
function del_photo(id){
    if (confirm('Уверены, что хотите удалить это фото?')){
    id = id || 0;

    $.ajax({
        type: "POST",
        url: '/ajax/photo_album.php',
        dataType: 'json',
        data: { action: "del_photo", photoId: id }
    }).success(
        function (msg){
            open_photo_album(msg.after_del.albumID);
            if (msg.after_del.redirect==true){
                photo_popup_close();
            }
            if (msg.after_del.openphoto){
                open_photo(msg.after_del.openphoto);
            }
            $('#photo_'+id).hide();
        });
    }
}

/**
 * Показ списка фотоальбомов пользователя
 * @param uid
 */
function update_photo_albums_list(uid){
    uid = uid || 0;
    $('#photos_box').load('/ajax_html/photo_albums_html.php', { 'uid': uid });
}

/**
 * Функция открывает заданный фотоальбом
 * @param albumID
 */
function open_photo_album(albumID){
    $('#photos_box').load('/ajax_html/photo_album_opened.php', {albumID: albumID, opened_profile: window.viewProfileID}).show();

}

/**
 * Открытие выбранного фото
 * @param photoID
 */
function open_photo(photoID){
    $('#photo_popup_box').load('/ajax_html/photo_get.php', {photoID: photoID, opened_profile: window.viewProfileID}).show();
    $('.b-photo-popup__overlay').show();
    $('.b-photo-popup').show();
}

/**
 * Закрытие окна просмотра фотографии
 */
function photo_popup_close(){
    $('.b-photo-popup__overlay').hide();
    $('.b-photo-popup').hide();
    $('#photo_popup_box').empty();
}

/**
 * Задает новое название альбому
 * @param albumID
 * @param albumOldDescription
 */
function set_name_photo_album(albumID, albumOldDescription){
    if (description = prompt('Описание альбома:', albumOldDescription)){
        $.ajax({
            type: "POST",
            url: '/ajax/photo_album.php',
            dataType: 'json',
            data: { action: "rename_album", albumID: albumID, textDescription: description }
        }).success(
            function (msg){
                open_photo_album(albumID);
            });
    }
}

//function load_comment(id, commentId){
//    $.ajax({
//        type: "POST",
//        url: '/ajax_html/photos.php',
//        data: { action: 'get_comment', photoId: id, commentId: commentId }
//    }).success(
//        function(msg){
//            $('#comments_photo_'+id).append(msg);
//        });
//    return false;
//}
//
//function add_comment(form){
//    id = $(form).children("input").val();
//    text = $(form).children("textarea").val();
//    $.ajax({
//        type: "POST",
//        url: '/ajax/photo_album.php',
//        dataType: 'json',
//        data: { action: "add_comment", photoId: id, text: text }
//    }).success(
//        function (msg){
//            $(form).children("textarea").val('');
//            load_comment(id, msg.new_comment_id)
//        });
//
//}
//
//function del_photo_comment(photoId, commentId){
//    if (confirm('Удалить комментарий?')){
//    $.ajax({
//        type: "POST",
//        url: '/ajax/photo_album.php',
//        dataType: 'json',
//        data: { action: "del_comment", photoId: photoId, commentId: commentId }
//    }).success(
//        function (msg){
//            if (msg.del_comment==1){
//                $('#photo_comment_'+commentId).hide();
//            }
//        });
//    }
//}