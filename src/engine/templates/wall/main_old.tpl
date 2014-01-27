
<script type="text/javascript">
    var lastWallID = 0;
    function add_wall(){
        $textarea = $('#wall_text_editor');
        $.ajax({
        type: "POST",
        url: '/ajax/add_wall.php',
        dataType: 'json',
        data: { text: $textarea.val(), opened_profile: window.viewProfileID}
    }).success(
        function(msg){
            if (msg.result=='ok'){
            loadNewWallItem(msg.wallItemID);
            $('#wall_text_editor').val('');
            }
    });
    }

    function loadNewWallItem(wallItemID){
        $.ajax({
            type: "POST",
            url: '/ajax_html/wall_item_byId.php',
            data: { wallItemID: wallItemID}
        }).success(
                function(msg){
                    $('#wall_container').prepend(msg);
                });
        return false;
    }

    function wall_load_more(startID){
        $.ajax({
            type: "POST",
            url: '/ajax_html/wall_load_more.php',
            data: { startID: startID}
        }).success(
                function(msg){
                    $('#wall_container').append(msg);
                });
        return false;
    }
    function dell_wall_byId(postID){
        $.ajax({
            type: "POST",
            url: '/ajax/del_wall.php',
            data: { postID: postID}
        }).success(
                function(msg){
                    $('#wall_'+postID).hide();
                });
        return false;
    }
</script>

<h1><span>Моя стена</span></h1>
<div class="wall_add">
    <div class="add_comment">
        <div class="slide">
            <a href=""><img src="{$user.avatar_url50x50}" /></a>
        </div>
        <div class="textarea">
            <div class="tab"><img src="/images/profile/panel.png" /></div>
            <textarea placeholder="Оставьте свое сообщение" id="wall_text_editor"></textarea>
            <input type="image" onclick="return add_wall()" src="/images/profile/add.png" alt="{t}send{/t}" />
        </div>
        <div class="clr"></div>
    </div>
</div>
<div id="wall_container" class="cont">
    {include file='wall/wall_items.tpl'}
</div>
<div class="cont">
    {if !empty($profile_wall_items)}
    <div><p id="wallNextButton"><a href="#" onclick="return wall_load_more(window.lastWallID)">подгрузить еще</a></p></div>
    {/if}
    <div class="clr"></div>
</div>

