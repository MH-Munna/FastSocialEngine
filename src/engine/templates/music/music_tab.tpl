<div class="b-block b-cabinet-wall__wrap b-cabinet-wall__wrap_music">
    <div class="b-block b-cabinet-wall__groups-header">
        <div class="b-inline b-cabinet-wall__groups-my-all b-cabinet-wall__groups-all b-cabinet-wall__groups-active">
            <a class="b-inline b-cabinet__chat-contact-list-button b-cabinet-wall__groups">
                <span class="b-inline b-participants__button-text b-cabinet-wall__groups-text">Моя музыка: 210 песен</span>
            </a>
        </div>
        <div class="b-inline b-cabinet-wall__groups-my-all b-cabinet-wall__groups-my">
            <a class="b-inline b-cabinet__chat-contact-list-button b-cabinet-wall__groups">
                <span class="b-inline b-participants__button-text b-cabinet-wall__groups-text">Вся музыка</span>
            </a>
        </div>
        <div class="b-inline b-cabinet-wall__groups-add-wrap">
            <a class="b-inline b-cabinet__chat-contact-list-button b-cabinet-wall__groups-add">
                <span class="b-inline b-cabinet-wall__groups-add-plus"></span>
                <span class="b-inline b-participants__button-text b-cabinet-wall__groups-text">Новый плейлист</span>
            </a>
        </div>
    </div>

    <div class="b-block b-cabinet-wall__chat-show-wrap g-out">
        <span class="b-inline b-cabinet-wall__chat-show">Сортировать:</span>
        <a class="b-inline b-cabinet__wall-button b-cabinet-wall__chat-show-button"><span class="b-block b-participants__button-text b-cabinet-wall__chat-show-button-text">все</span></a>
        <a class="b-inline b-cabinet__wall-button b-cabinet-wall__chat-show-button"><span class="b-block b-participants__button-text b-cabinet-wall__chat-show-button-text">дата</span></a>
        <a class="b-inline b-cabinet__wall-button b-cabinet-wall__chat-show-button"><span class="b-block b-participants__button-text b-cabinet-wall__chat-show-button-text">исполнитель</span></a>

        <div class="g-out b-inline b-cabinet-wall__music-playlist my-select">
            <select class="select">
                <option value=""></option>
                {foreach item=con from=$op.media.playlists}
                <option value="{$con.id}">{$con.vc_name}</option>
                {/foreach}
            </select>
        </div><!--
 --><a class="b-inline b-search__form-img-wrap b-cabinet-wall__music-playlist-img">
            <img alt="Search" class="b-title__border-img" height="17" src="{$i.base_url}/assets/groups/search/search.png" width="17" />
        </a>
        <div style="width: 100%; margin-top: 10px;"><audio preload></audio></div>

    </div>
    <div id="opened_playlist">
    {foreach item=audio from=$op.media.tracks}
    <div class='b-cabinet-wall__music-item'>

        <a href='#' onclick="return playAudioTrack({$audio.id})" data-src='{$audio.media_url}' class='b-inline b-cabinet-wall__music-icon-play audio-play-button' id="audioTrackID-{$audio.id}"></a>
        {$audio.vc_name}
        {*— <span class='b-cabinet-wall__music-item-description'>Длинное название исполнителя</span>*}
        <span class='b-cabinet-wall__music-item-date'>{$audio.duration}</span>
        <div class='b-cabinet-wall__music-icons'>
            <a href='#' class='b-cabinet-wall__music-icon-p'></a>
            <a href='#' class='b-cabinet-wall__music-icon-down'></a>
            <a href='#' class='b-cabinet-wall__music-icon-close'></a>
        </div>
    </div>
    {/foreach}
    </div>
</div>
