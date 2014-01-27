{include file='main/head.tpl'}
{include file='main/top.tpl'}
{include file='main/search_block.tpl'}

<script>
    window.viewProfileID = {$op.info.id};
    window.myProfileID = {$u.info.id};
    window.lastEventId = 0;
    window.base_site_url = '{$i.base_url}';
</script>

<script>
    window.onload=function(){
        $('#beg_stroka').show(1500);
        {if $user.i_profile_info eq '0'}
        get_my_config();
        {/if}
    };
    audiojs.events.ready(function() {
        var a = audiojs.createAll();

        // Load in the first track
        window.audio = a[0];
        first = $('.b-cabinet-wall__music-icon-play').attr('data-src');
        window.audio.load(first);

        // Load in a track on click
        /*
        $('.b-cabinet-wall__music-icon-play').click(function(e) {
            e.preventDefault();
            //$(this).addClass('playing').siblings().removeClass('playing');
            audio.load($('b-cabinet-wall__music-icon-play').attr('data-src'));
            audio.play();
            //return false;
        });
        */
        /*
         // Keyboard shortcuts
         $(document).keydown(function(e) {
         var unicode = e.charCode ? e.charCode : e.keyCode;
         // right arrow
         if (unicode == 39) {
         var next = $('li.playing').next();
         if (!next.length) next = $('ol li').first();
         next.click();
         // back arrow
         } else if (unicode == 37) {
         var prev = $('li.playing').prev();
         if (!prev.length) prev = $('ol li').last();
         prev.click();
         // spacebar
         } else if (unicode == 32) {
         audio.playPause();
         }*/
    });


</script>

<div class="l-base l-cabinet g-out">
<div class="b-inline l-cabinet__left">
    <div class="b-block b-cabinet__user-wrap">
        <div class="b-block b-cabinet__user-avatar">
            <a href="#" onclick="return click_to_load_main_avatar()" class="avatar">
            <img id="opened_profile_main_avatar" alt="Foto" class="b-block" height="233" src="{$op.info.avatar_url233x233}" width="234" />

            <div class="b-cabinet__user-avatar-wrap"></div>
            </a>

            <div style='display: none;'>
                <script>
                    function start_upload_avatar(){
                        $('#opened_profile_main_avatar').fadeTo('slow', 0.5);
                        document.uploadavatar.submit();
                    }
                </script>

                <div class="upload-avatar">
                    <form target="hiddenframe-avatar" enctype="multipart/form-data" action="/uploads/upload_avatar.php" method="post" name="uploadavatar">
                        <input type="file" id="upload_avatar" name="upload_avatar" onchange="start_upload_avatar();" />
                        <iframe name="hiddenframe-avatar" class="hiddenframe-avatar"></iframe>
                    </form>
                </div>

                <div class="upload-avatar" id="upload-avatar">
                </div>
                <div class="console-avatar" id="console-avatar">
                </div>
            </div>
        </div>
        <div class="b-inline b-cabinet__user-stars">
            <img alt="Star active" class="b-inline" height="17" src="{$i.base_url}/assets/cabinet/avatar/star-active.png" width="18" />
            <img alt="Star active" class="b-inline" height="17" src="{$i.base_url}/assets/cabinet/avatar/star-active.png" width="18" />
            <img alt="Star active" class="b-inline" height="17" src="{$i.base_url}/assets/cabinet/avatar/star-active.png" width="18" />
            <img alt="Star" class="b-inline" height="17" src="{$i.base_url}/assets/cabinet/avatar/star.png" width="18" />
            <img alt="Star" class="b-inline" height="17" src="{$i.base_url}/assets/cabinet/avatar/star.png" width="18" />
            <img alt="Star" class="b-inline" height="17" src="{$i.base_url}/assets/cabinet/avatar/star.png" width="18" />
            <img alt="Star" class="b-inline" height="17" src="{$i.base_url}/assets/cabinet/avatar/star.png" width="18" />
        </div>
        <span class="b-inline b-cabinet__user-prize">25</span>
        <span class="b-inline b-cabinet__user-vip">VIP</span>
        <h2 class="b-block b-cabinet__user-name">{$op.info.ch_fname} {$op.info.ch_lname}</h2>
        <span class="b-block b-cabinet__user-birth">{$op.info.d_bdate}</span>
        <a onclick="return show_mini_info(this, 'city');" class="b-inline b-cabinet__user-button b-cabinet__user-button-active"><span class="b-inline b-participants__button-text b-cabinet__user-button-text">страна / город</span></a>
        <a onclick="return show_mini_info(this, 'status');" class="b-inline b-cabinet__user-button"><span class="b-inline b-participants__button-text b-cabinet__user-button-text">статус</span></a>
        <a onclick="return show_mini_info(this, 'hobbi');" class="b-inline b-cabinet__user-button"><span class="b-inline b-participants__button-text b-cabinet__user-button-text">хобби</span></a>
        <a onclick="return show_mini_info(this, 'mechta');" class="b-inline b-cabinet__user-button"><span class="b-inline b-participants__button-text b-cabinet__user-button-text">мечта</span></a>
        <span class="b-block b-cabinet__user-city city">{$op.info.vc_country} / {$op.info.vc_city}</span>
        <span class="b-block b-cabinet__user-city status" style="display: none;">{$op.info.vc_status}</span>
        <span class="b-block b-cabinet__user-city hobbi" style="display: none;">{$op.info.ch_hobbi}</span>
        <span class="b-block b-cabinet__user-city mechta" style="display: none;">{$op.info.ch_mechta}</span>
    </div>

    {include file='friends/friends_list.tpl'}

    {include file='main/reklam_include/ban240x100.tpl' ban=$ban[1]}
    {include file='main/reklam_include/ban240x100.tpl' ban=$ban[2]}
    {include file='main/reklam_include/ban240x100.tpl' ban=$ban[3]}

</div><!--
--><div class="b-inline l-cabinet__center g-out">
<div class="b-block b-cabinet-drop g-out">
    {include file='main/win_today.tpl'}
    {include file='main/multivisor.tpl'}
</div>
<div class="b-block b-cabinet-wall">
    {include file='main/wall_header.tpl'}
    <span class="b-block b-cabinet-wall__header-active"></span>
    {include file='wall/wall_tab.tpl'}
    {include file='groups_tab/groups_tab.tpl'}
    <div class="b-block b-cabinet-wall__wrap b-cabinet-wall__wrap_video" id="videos_box">
        {include file='videos/videos_tab.tpl'}
    </div>
    {include file='music/music_tab.tpl'}
    {include file='dialogs/chat_tab.tpl'}
    {include file='aviter/aviter_tab.tpl'}
    <div class="b-block b-cabinet-wall__wrap b-cabinet-wall__wrap_photo" id="photos_box">
        {include file="photo/photo_album_tab.tpl"}
    </div>
    {include file='podarki/podarki_tab.tpl'}
    <div class="b-block b-cabinet-wall__wrap b-cabinet-wall__wrap_games" id="tabContent_apps">
        {include file='apps/apps_tab.tpl'}
    </div>
</div>
</div><!--
--><div class="b-inline l-cabinet__right">
    {include file='main/buttons.tpl'}
    {include file='news/news_widget.tpl'}
    {include file='votes/votes_widget.tpl'}
    <a href="#" class="b-block b-cabinet__chat-contact-list-button b-cabinet__right-button b-cabinet-vote__button"><span class="b-inline b-cabinet-vote__button-text">Проголосовать</span></a>
</div>
<div class="b-block b-cabinet__cat-dog" id="main_game" onclick="start_main_game();"></div>
    {include file='eat-table/eat_widget.tpl'}
    {include file='main/partners.tpl'}
</div>

{include file='main/footer.tpl'}