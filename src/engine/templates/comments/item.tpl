{*
<div id="wall_{$con.id}" class="comment">
    <div class="slide">
        <a href="/profile/{$con.user_info.id}" onclick="open_profile({$con.user_info.id});" >
            <img src="{$con.user_info.avatar_url50x50}" /></a>
    </div>
    <div class="comm">
        <span class="family">{$con.user_info.ch_fname} {$con.user_info.ch_lname}</span><br />
        <span class="date">{$con.ts}</span>
        <p class="icon">
            <span class="cit"><img src="/images/profile/cit.png" /></span>
            <span class="cit"><img src="/images/profile/p.png" /></span>
            <span class="del" onclick="return dell_wall_byId({$con.id});" ><img src="/images/profile/del.png" /></span>
        </p>
        <div class="clr"></div>
        <p class="pr">{$con.text}</p>
        <a href="" class="comments">Комментировать</a>
    </div>
    <div class="clr"></div>
</div>
*}

<div id="wall_{$con.id}" class="b-block b-cabinet-wall__avitter-avitt-wrap b-cabinet-wall__avitter-avitt-wrap_photo-popup comment">
    <a href="{$i.base_url}/profile/{$con.user_info.id}" onclick="return open_profile({$con.user_info.id});" class="b-inline b-title__border">
        <img alt="{$con.user_info.ch_fname} {$con.user_info.ch_lname}" class="b-block b-title__border-img" height="50" src="{$con.user_info.avatar_url50x50}" width="50" />
    </a>
    <div class="b-inline b-cabinet-wall__avitter-avitt">
        <a href="#" class="b-block b-cabinet-wall__avitter-avitt-name">{$con.user_info.ch_fname} {$con.user_info.ch_lname}</a>
        <p class="b-block b-cabinet-wall__avitter-avitt-date-time"><span class="b-inline b-cabinet-wall__avitter-avitt-date">{$con.ts}</span><span class="b-inline b-cabinet-wall__avitter-avitt-time"></span></p>
        <div class="b-block b-cabinet-wall__avitter-avitt-text">{$con.text}</div>
        {*<a href="" class="b-cabinet-wall__avitter-avitt-link" id="link-1"></a>*}
        {*<a href="" class="b-cabinet-wall__avitter-avitt-link" id="link-2"></a>*}
        <a href="#" onclick="return delete_comment({$con.id});" class="b-cabinet-wall__avitter-avitt-link" id="link-3"></a>
    </div>
{*
    <div class="b-block b-cabinet-wall__avitter-avitt-comm-wrap">
        <a href="#" onclick="return start_comment_to_coment({$con.id});" class="b-block b-cabinet-wall__avitter-avitt-comm">Комментировать</a>
        <div class="b-inline b-title__border-wrap b-title__border-wrap_comment comment_wall_{$con.id}">
            <a href="{$i.base_url}/profile/{$con.user_info.id}" onclick="return open_profile({$con.user_info.id});" class="b-block b-title__border">
                <img alt="{$con.user_info.ch_fname} {$con.user_info.ch_lname}" class="b-block b-title__border-img" height="29" src="{$con.user_info.avatar_url50x50}" width="29" />
            </a>
        </div>
        <form class="b-inline b-comment__form comment_wall_{$con.id}">
            <input class="b-inline b-comment__input b-cabinet-wall__avitter-avitt-comm-input" type="text">
            <input class="b-inline b-comment__input-clear b-cabinet-wall__avitter-avitt-clear" type="reset" value="">
        </form>
        <a href="#" class="b-inline b-billet__button b-comment__send comment_wall_{$con.id}">
            <span class="b-inline b-billet__button-text">Отправить</span>
        </a>
    </div>
*}
</div>