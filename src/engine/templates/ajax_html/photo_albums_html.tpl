<ul class="photoalbum-list">
    {foreach item=con from=$profile_photo_albums}
        <li class="photoalbum">
            <a href="#" onclick="open_photo_album({$con.id}); return false;">
                <img src="{$con.vc_url199x139_photo_cover}" alt="" width="199" height="139" />
                <span class="close"></span>
                <span class="photoalbum_label">
                    <span class="photoalbum_title">{$con.ch_name}</span>
                    <span class="photo_quantity">{$con.count_photos} {$con.count_photos|plural:'фотография':'фотографии':'фотографий'}</span>
                </span>
            </a>
            {if $session_uid eq $opened_profile}<a href="#" onclick="del_photo_album({$con.id}); return false;"  class="photoalbum_close"></a>{/if}
        </li>
    {*<div style="float: left">*}
    {*<img src="{$con.vc_url100x100_photo_cover}" alt=""/><br />*}
    {*<a href="#" onclick="open_photo_album({$con.id}); return false;">{$con.ch_name} ({$con.id})</a><br />*}
    {*{if $session_uid eq $opened_profile}<a onclick="del_photo_album({$con.id}); return false;" href="#">Удалить</a><br />{/if}*}
    {*</div>*}
    {foreachelse}
    {*Ничего не найдено*}
{/foreach}
</ul>