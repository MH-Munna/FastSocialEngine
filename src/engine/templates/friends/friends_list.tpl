<figure class="b-block b-participants">
    <h2 class="b-participants__header">Мои друзья</h2>
    <img alt="Shadow" class="b-title__border-img" height="11" src="{$i.base_url}/assets/groups/group-info/shadow.png" width="240" />
    <div class="b-block b-participants__slider">
        <div class="b-participants__arrow b-participants__arrow_top"></div>
        <div class="b-block b-participants__cover">
            <div class="b-block b-participants__wrap" style="height: 444px">
                {foreach item=con from=$op.friends}
                <div class="b-inline b-title__border-wrap b-title__border-wrap_participants">
                    <a href="{$i.base_url}/profile/{$con.id}" onclick="return open_profile({$con.id});" class="b-block b-title__border b-title__user">
                        <img alt="{$con.ch_fname} {$con.ch_lname}" class="b-block b-title__border-img" height="50" src="{$con.avatar_url50x50}" width="50" />
                    </a>
                </div>
                {foreachelse}
                {/foreach}
            </div>
        </div>
        <div class="b-participants__arrow b-participants__arrow_bottom"></div>
    </div>
    <div class="b-block b-participants__new-wrap">
        {foreach item=con from=$op.requestes_to_friend}
        <div class="b-block b-participants__new" id="request_{$con.user_info.id}">
            <span class="b-block b-participants__new-name">{$con.user_info.ch_fname} {$con.user_info.ch_lname}</span>
            <a href="/profile/{$con.user_info.id}" class="b-inline b-title__border">
                <img alt="{$con.user_info.ch_fname} {$con.user_info.ch_lname}"
                     class="b-block b-title__border-img" height="50"
                     src="{$con.user_info.avatar_url50x50}" width="50" />
            </a>
            {*<div class="b-inline b-participants__new-info">*}
                {*<span class="b-block b-participants__new-date">22.03.2013</span>*}
                {*<span class="b-block b-participants__new-time">15:32</span>*}
            {*</div>*}
            <div class="b-inline">
                <a href="#" onclick="add_friend({$con.user_info.id}, 'request_{$con.user_info.id}'); return false;" class="b-block b-cabinet__chat-contact-list-button b-participants__new-button">
                    <span class="b-inline b-participants__new-button-text">Подтвердить</span>
                </a>
                <a href="#" class="b-block b-cabinet__chat-contact-list-button b-participants__new-button">
                    <span class="b-inline b-participants__new-button-text">Отменить</span>
                </a>
            </div>
        </div>
        {foreachelse}
        {/foreach}
    </div>
    <div class="b-block b-participants__bottom">
        <a href="#" class="b-inline b-participants__bottom-text" id="my-friends_online">on-line 27</a>
        <a href="#" class="b-inline b-participants__bottom-text" id="my-friends_all">все 27</a>
        {if $u.info.id eq $op.info.id}
        <a href="#" class="b-inline b-participants__bottom-text" id="my-friends_new">заявки {$op.requestes_to_friend_count}</a>
        {/if}
    </div>
</figure>