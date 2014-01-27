<div class="comment" id="photo_comment_{$con.id}">
    <div class="slide">
        <a onclick="open_profile({$con.fk_user});" href="/profile/{$con.fk_user}">
            <img src="{$con.user_info.avatar_url50x50}"></a>
    </div>
    <div class="comm">
        <span class="family">{$con.user_info.ch_fname} {$con.user_info.ch_lname}</span><br>
        <span class="date">{$con.time}</span>
        <p class="icon">
            {*<span class="cit"><img src="/images/profile/cit.png"></span>*}
            {*<span class="cit"><img src="/images/profile/p.png"></span>*}
            {if $user.id eq $con.fk_user or $user.id eq $photo_info.fk_user}
            <span onclick="del_photo_comment({$photo_info.id}, {$con.id}); return false;" class="del"><img src="/images/profile/del.png"></span>
            {/if}
        </p>
        <div class="clr"></div>
        <p class="pr">{$con.text}</p>

    </div>
    <div class="clr"></div>
</div>
