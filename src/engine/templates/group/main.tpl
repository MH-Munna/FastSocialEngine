{include file='main/head.tpl'}
{include file='main/top.tpl'}
{include file='main/search_block.tpl'}

<script>
    {*window.viewProfileID = {$op.info.id};*}
    {*window.myProfileID = {$u.info.id};*}
    {*window.lastEventId = 0;*}
    window.base_site_url = '{$i.base_url}';
</script>

<script>
    window.onload=function(){
        $('#beg_stroka').show(1500);
        {if $user.i_profile_info eq '0'}
        get_my_config();
        {/if}
    };
</script>

<div class="l-base l-cabinet g-out">
    <div class="b-inline l-cabinet__left">
        <div class="b-block b-cabinet__user-wrap">
            <div class="b-block b-cabinet__user-avatar">
                <a href="#" onclick="return click_to_load_main_avatar()" class="avatar">
                    <img id="opened_profile_main_avatar" alt="Foto" class="b-block" height="233" src="{$og.info.avatar_url233x233}" width="234" />

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
        </div>


    </div><!--
--><div class="b-inline l-cabinet__center g-out">
        <div class="b-block b-cabinet-wall">
            <div>
                <p>Стена:</p>
                {include file="comments/com.tpl" id=$og.info.id type='group_wall'}
            </div>
        </div>
    </div><!--
--><div class="b-inline l-cabinet__right">
        {include file='main/buttons.tpl'}
        {include file='news/news_widget.tpl'}
        {include file='votes/votes_widget.tpl'}
        <a href="#" class="b-block b-cabinet__chat-contact-list-button b-cabinet__right-button b-cabinet-vote__button"><span class="b-inline b-cabinet-vote__button-text">Проголосовать</span></a>
    </div>

    {include file='main/partners.tpl'}
</div>

{include file='main/footer.tpl'}