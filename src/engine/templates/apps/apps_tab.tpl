<div class="b-block b-cabinet-wall__groups-header">
<div class="b-inline b-cabinet-wall__groups-my-all b-cabinet-wall__groups-all b-cabinet-wall__groups-active">
<a class="b-inline b-cabinet__chat-contact-list-button b-cabinet-wall__groups">
<span class="b-inline b-participants__button-text b-cabinet-wall__groups-text">Мои игры - 10</span>
</a>
</div>
<div class="b-inline b-cabinet-wall__groups-my-all b-cabinet-wall__groups-my" id="choice_my">
<a class="b-inline b-cabinet__chat-contact-list-button b-cabinet-wall__groups">
<span class="b-inline b-participants__button-text b-cabinet-wall__groups-text">Все игры - 1 425</span>
</a>
</div>
<div class="b-inline b-cabinet-wall__groups-add-wrap">
<a class="b-inline b-cabinet__chat-contact-list-button b-cabinet-wall__groups-add" href="#" onclick="create_app(); return false;">
<span class="b-inline b-cabinet-wall__groups-add-plus"></span>
<span class="b-inline b-participants__button-text b-cabinet-wall__groups-text">Создать приложение</span>
</a>
</div>
</div>
<div class="b-block b-cabinet-wall__chat-show-wrap b-cabinet-wall__games-genres">
<span class="b-inline b-cabinet-wall__chat-show">Жанры:</span>
<a class="b-inline b-cabinet__wall-button b-cabinet-wall__chat-show-button"><span class="b-block b-participants__button-text b-cabinet-wall__chat-show-button-text">Действие - 10</span></a>
<a class="b-inline b-cabinet__wall-button b-cabinet-wall__chat-show-button"><span class="b-block b-participants__button-text b-cabinet-wall__chat-show-button-text">Стрельба - 1</span></a>
<a class="b-inline b-cabinet__wall-button b-cabinet-wall__chat-show-button"><span class="b-block b-participants__button-text b-cabinet-wall__chat-show-button-text">Классика - 54</span></a>
<a class="b-inline b-cabinet__wall-button b-cabinet-wall__chat-show-button"><span class="b-block b-participants__button-text b-cabinet-wall__chat-show-button-text">Движение - 11</span></a>
<a class="b-inline b-cabinet__wall-button b-cabinet-wall__chat-show-button"><span class="b-block b-participants__button-text b-cabinet-wall__chat-show-button-text">Треш - 0</span></a>
<a class="b-inline b-cabinet__wall-button b-cabinet-wall__chat-show-button"><span class="b-block b-participants__button-text b-cabinet-wall__chat-show-button-text">Другое - 38</span></a>
<a class="b-inline b-cabinet__wall-button b-cabinet-wall__chat-show-button"><span class="b-block b-participants__button-text b-cabinet-wall__chat-show-button-text">Архив - 700</span></a>
</div>
<div class='b-cabinet-wall__photos'>

{foreach item=con from=$op.apps}
<a href='#' class='b-inline b-cabinet-wall__games_wrap'>
<img alt="" height="138" src="{$i.base_url}/assets/cabinet/wall/games/game.jpg" width="138" />
<div class="b-cabinet-wall__games">
{if $u.info.id eq $op.info.id}
<div class="b-cabinet-wall__video-settings" onclick="get_app_config({$con.id}); return false;"></div>
{/if}
<div class="b-cabinet-wall__video-close" onclick="del_app({$con.id}) return false;"></div>
<p class="b-cabinet-wall__games-info" onclick="start_app({$con.id}); return false;">
<span class="b-cabinet-wall__games-name">{$con.app_name}</span>
{*<span class="b-block b-cabinet-wall__games-party">0 участников</span>*}
</p>
</div>
</a>
{foreachelse}
{/foreach}
</div>