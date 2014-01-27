<div class="b-block b-cabinet-wall__groups-header">
    <div class="b-inline b-cabinet-wall__groups-my-all b-cabinet-wall__groups-all b-cabinet-wall__groups-active">
        <a class="b-inline b-cabinet__chat-contact-list-button b-cabinet-wall__groups">
            <span class="b-inline b-participants__button-text b-cabinet-wall__groups-text">Мои видео - {$op.videos_count}</span>
        </a>
    </div>
    <div class="b-inline b-cabinet-wall__groups-my-all b-cabinet-wall__groups-my">
        <a class="b-inline b-cabinet__chat-contact-list-button b-cabinet-wall__groups">
            <span class="b-inline b-participants__button-text b-cabinet-wall__groups-text">Все видео</span>
        </a>
    </div>
    <div class="b-inline b-cabinet-wall__groups-add-wrap">
        <a class="b-inline b-cabinet__chat-contact-list-button b-cabinet-wall__groups-add" onclick="return load_video();">
            <span class="b-inline b-cabinet-wall__groups-add-plus"></span>
            <span class="b-inline b-participants__button-text b-cabinet-wall__groups-text">Добавить видео</span>
        </a>
    </div>
</div>
<div class='b-cabinet-wall__photos'>
    {foreach item=con from=$op.videos}
    <a href='{$con.id}' onclick="return open_video({$con.id});" class='b-inline b-cabinet-wall__video'>
        <img alt="" height="140" src="{$con.sv.img}" width="200" />
        <img alt="" class="b-cabinet-wall__video-play" height="38" src="{$con.base_url}/assets/cabinet/wall/video/play.png" width="38" />
        {*<div class="b-cabinet-wall__video-close"></div>*}
        <div class='b-cabinet-wall__photo-description-wrap'>
            <div class='b-cabinet-wall__photo-description'>{$con.vc_name}</div>
            <div class='b-cabinet-wall__photo-description-count'>{$con.sv.view} {$con.sv.view|plural:'просмотр':'просмотра':'просмотров'}</div>
        </div>
    </a>
    {/foreach}
</div>