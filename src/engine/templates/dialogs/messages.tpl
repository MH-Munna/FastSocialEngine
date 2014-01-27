{foreach item=con from=$d.messages}
    <div class="b-block b-cabinet-wall__chat-post-wrap">
        <a href="#" class="b-inline b-title__border"><img alt="User 0" class="b-block b-title__border-img" height="40" src="{$con.user_info.avatar_url50x50}" width="40" /></a>
        <div class="b-inline b-cabinet-wall__chat-post">
            <a href="#" class="b-inline b-cabinet-wall__chat-post-author">{$con.user_info.ch_fname} {$con.user_info.ch_lname}</a>
            <span class="b-inline b-cabinet-wall__chat-post-time">{$con.ts.1}</span>
            <p class="b-block b-cabinet-wall__chat-post-text">{$con.message}</p>
        </div>
        <span class="b-inline b-cabinet-wall__chat-post-data">{$con.ts.0}</span>
    </div>
    {foreachelse}
{/foreach}