<div class="friends">
        <p class="prev" href="#"><img src="/images/profile/prev.png"></p>
        <div class="slides slider-box">
            <div class="slide">
                {foreach item=con from=$profile_friends}
                    <a href="/profile/{$con.id}" title="{$con.ch_fname} {$con.ch_lname}" onclick="open_profile({$con.id});"><img src="{$con.avatar_url50x50}"></a>
                {foreachelse}
                {/foreach}
            </div>
        </div>
        <p class="next slider-down"><img src="/images/profile/next.png"></p>
        <p class="stat">
            <a href="">on-line 72</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="">все 72</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {if $opened_profile_info.id eq $user.id}
            <a href="#" onclick="get_requestes(); return false;">заявки {$requestes_to_friend_count}</a>
            {/if}
        </p>
</div>