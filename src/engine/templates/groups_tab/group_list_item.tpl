<a href='{$i.base_url}/group/{$group_item.id}' onclick="return open_profile({$group_item.id});" class='b-inline b-cabinet-wall__groups-wrap'>
    <img alt="" height="140" src="{$group_item.avatar_url233x233}" width="200" />
    {*<span class="b-inline b-cabinet-wall__groups-number">+181</span>*}
    <div class='b-cabinet-wall__photo-description-wrap'>
        <div class='b-cabinet-wall__photo-description'>{$group_item.ch_group_name}</div>
        <div class='b-cabinet-wall__photo-description-count'>{$group_item.i_members} {$group_item.i_members|plural:'участник':'участника':'участников'}</div>
    </div>
</a>