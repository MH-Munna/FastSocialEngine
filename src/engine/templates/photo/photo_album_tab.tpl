    <div class='b-cabinet-wall__photo-wrap'>
        {if $op.info.id eq $u.info.id}
        <div class="b-inline b-cabinet-wall__groups-add-wrap"  onclick="create_photo_album(); return false;">
            <a class="b-inline b-cabinet__chat-contact-list-button b-cabinet-wall__groups-add">
                <span class="b-inline b-cabinet-wall__groups-add-plus"></span>
                <span class="b-inline b-participants__button-text b-cabinet-wall__groups-text">Создать фотоальбом</span>
            </a>
        </div>
        {/if}
        <span class='b-inline b-cabinet-wall__photo-header b-cabinet-wall__photo-header_active'>Фотоальбомы</span>
    </div>
    <div class='b-cabinet-wall__photos'>
        {foreach item=con from=$op.photo_albums}
            <a href='#' onclick="open_photo_album({$con.id}); return false;" class='b-inline b-cabinet-wall__photo'>
                <img alt="" height="140" src="{$con.vc_url199x139_photo_cover}" width="200" />
                <div class='b-cabinet-wall__photo-description-wrap'>
                    <div class='b-cabinet-wall__photo-description'>{$con.ch_name}</div>
                    <div class='b-cabinet-wall__photo-description-count'>{$con.count_photos} {$con.count_photos|plural:'фотография':'фотографии':'фотографий'}</div>
                </div>
            </a>
        {/foreach}
    </div>