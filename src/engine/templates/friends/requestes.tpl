{foreach item=con from=$requests}
    <div>
    <a href="/profile/{$con.user_info.id}" title="{$con.user_info.ch_fname} {$con.user_info.ch_lname}" onclick="open_profile({$con.user_info.id});">
        <img src="{$con.user_info.avatar_url50x50}">
        <p>{$con.user_info.ch_fname} {$con.user_info.ch_lname}</p>
    </a>
    <input type="button" onclick="add_friend({$con.user_info.id})" value="Подтвердить" />
    </div>
    {foreachelse}
    Нет ни одной заявки
{/foreach}