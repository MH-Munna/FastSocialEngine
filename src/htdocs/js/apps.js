function create_app(){ //Создает новый альбом у пользователя
    $.ajax({
        type: "POST",
        url: '/ajax/apps_orginize.php',
        dataType: 'json',
        data: { action: "create_app" }
    }).success(
        function( msg ) {
            update_apps_list();
        });

}

function del_app(id){
    if (confirm('Вы действительно хотите удалить приложение со своей страницы?')){
    $.ajax({
        type: "POST",
        url: '/ajax/apps_orginize.php',
        dataType: 'json',
        data: { action: "del_app", app_id: id }
    }).success(
        function( msg ) {
            if (msg==true){
                update_apps_list();
            }
        });
    }
}

function add_app_to_me(id){
    $.ajax({
        type: "POST",
        url: '/ajax/apps_orginize.php',
        dataType: 'json',
        data: { action: "add_app_to_me", app_id: id }
    }).success(
        function( msg ) {
            if (msg==true){
            }
    });
}

function update_apps_list(uid){
    uid = uid || 0;
    $('#tabContent_apps').load('/ajax_html/apps_installed_items.php', { 'opened_profile': uid });
}

function get_app_config(app_id){
    $.colorbox({href: '/ajax_html/app_config.php', width: '80%', height: '80%', data: {app_id: app_id}});
}

function start_app(app_id){
    $.colorbox({href: '/ajax_html/app_start.php', width: 774, height: 620, data: {app_id: app_id}});
}

function app_change_type(type){
    $("#app_config_swf_tab").hide();
    $("#app_config_iframe_tab").hide();

    if (type=="swf"){
        $("#app_config_swf_tab").show();
    }
    if (type=="iframe"){
        $("#app_config_iframe_tab").show();
    }
}

function app_save(formID){
    $.ajax({
            type: "POST",
            url: '/ajax/save_apps_settings.php',
            dataType: 'json',
            data: $("#"+formID).serialize()
        }).success(
            function( msg ){
                if (msg.result=='ok'){
                    alert('Настройки сохранены');
                }
            }
        );
}

function showOrderBox(params){

}