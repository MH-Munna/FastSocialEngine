<div class="tab_inner">
    <div class="filtr">
        <h3>Фотоальбомы</h3>
        {if $session_uid eq $opened_profile}
            <div class="new" onclick="create_photo_album(); return false;">
                <span class="plus"></span>
                <span class="btn-text">Создать фотоальбом</span>
                <span class="corner"></span>
            </div>
        {/if}
    </div>

    <ul class="photoalbum-list">

        <div id="photo_albums_div">
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
                    {foreachelse}
                {/foreach}
            </ul>
        </div>
</div>
