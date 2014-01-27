{foreach item=con from=$profile_wall_items}
    <div id="wall_{$con.id}" class="comment">
        <div class="slide">
            <a href="/profile/{$con.user_id}" onclick="open_profile({$con.fk_user});" >
            <img src="{$con.user_avatar_url50x50}" /></a>
        </div>
        <div class="comm">
            <span class="family">{$con.user_name}</span><br />
            <span class="date">23.03.2013 | 15:35</span>
            <p class="icon">
                <span class="cit"><img src="/images/profile/cit.png" /></span>
                <span class="cit"><img src="/images/profile/p.png" /></span>
                <span class="del" onclick="return dell_wall_byId({$con.id});" ><img src="/images/profile/del.png" /></span>
            </p>
            <div class="clr"></div>
            <p class="pr">{$con.t_content}</p>
            <a href="" class="comments">Комментировать</a>
        </div>
        <div class="clr"></div>
    </div>
    <script type="text/javascript">
        window.lastWallID = {$con.id};
        {if $con.prev_wall eq 0}
        $('#wallNextButton').hide();
        {/if}
    </script>
    {foreachelse}
{/foreach}