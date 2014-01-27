{*
<div class="wall_add">
    <div class="add_comment">
        <div class="slide">
            <a href=""><img src="{$user.avatar_url50x50}" /></a>
        </div>
        <div class="textarea">
            <div class="tab"><img src="/images/profile/panel.png" /></div>
            <div class="divcontent" contenteditable="true" placeholder="Оставьте свое сообщение" id="{$type}_text_editor"></div>
            <input type="image" onclick="add_comment({$com},'{$type}')" src="/images/profile/add.png" alt="{t}send{/t}" />
        </div>
        <div class="clr"></div>
    </div>
</div>
<div id="{$type}_{$com}_container" class="cont">
    {include file='comments/items.tpl' comms=$comms}
</div>
<div class="cont">
    {if !empty($profile_wall_items)}
    <div><p id="wallNextButton"><a href="#" onclick="return wall_load_more(window.lastWallID)">подгрузить еще</a></p></div>
    {/if}
    <div class="clr"></div>
</div>
*}


    <script>
        $(document).ready(function(){
            $('#comment_{$type}_{$id}').ckeditor();
        });
    </script>

    <div class="b-block b-cabinet__ckeditor b-cabinet__ckeditor_relative b-cabinet__ckeditor_full">
        <a href="{$i.base_url}/profile/{$u.info.id}" onclick="return open_profile({$u.info.id});" class="b-inline b-title__border"><img alt="{$u.info.ch_fname} {$u.info.ch_lname}" class="b-block b-title__border-img" height="40" src="{$u.info.avatar_url50x50}" width="40" /></a>
        <textarea class='b-inline' id='comment_{$type}_{$id}' name="comment"></textarea>
        <a class="b-block b-cabinet__chat-contact-list-button b-cabinet-wall__chat-contact-list-button b-cabinet__ckeditor-button" onclick="add_comment({$id},'{$type}')">
            <span class="b-inline b-participants__button-text b-cabinet-wall__chat-contact-list-button-text">Отправить</span>
        </a>
    </div>
    <div class="b-block b-cabinet-wall__comment cont" id="{$type}_{$id}_container">

        {include file='comments/items.tpl' comms=$comms}





        {*
        <div class="b-block b-cabinet-wall__avitter-avitt-wrap b-cabinet-wall__avitter-avitt-wrap_photo-popup b-cabinet-wall__avitter-avitt-wrap_photo_indent">
            <a href="#" class="b-inline b-title__border"><img alt="User 7" class="b-block b-title__border-img" height="50" src="{$i.base_url}/assets/groups/img/user/user-7.jpg" width="50" /></a>
            <div class="b-inline b-cabinet-wall__avitter-avitt">
                <a href="#" class="b-block b-cabinet-wall__avitter-avitt-name">Имя Фамилия</a>
                <p class="b-block b-cabinet-wall__avitter-avitt-date-time"><span class="b-inline b-cabinet-wall__avitter-avitt-date">10.03.2013</span> | <span class="b-inline b-cabinet-wall__avitter-avitt-time">15:35</span></p>
                <p class="b-block b-cabinet-wall__avitter-avitt-text">Вращение, несмотря на некоторую погрешность, ортогонально искажает  пирокластический ПИГ, не забывая о том, что интенсивность диссипативных  сил, характеризующаяся величиной коэффициента D, должна лежать...</p>
                <a href="" class="b-cabinet-wall__avitter-avitt-link" id="link-1"></a>
                <a href="" class="b-cabinet-wall__avitter-avitt-link" id="link-2"></a>
                <a href="" class="b-cabinet-wall__avitter-avitt-link" id="link-3"></a>
            </div>
            <div class="b-block b-cabinet-wall__avitter-avitt-comm-wrap">
                <a href="#" class="b-block b-cabinet-wall__avitter-avitt-comm">Комментировать</a>
                <div class="b-inline b-title__border-wrap b-title__border-wrap_comment">
                    <a href="#" class="b-block b-title__border"><img alt="User 3" class="b-block b-title__border-img" height="29" src="{$i.base_url}/assets/groups/img/user/user-3.jpg" width="29" /></a>
                </div>
                <form class="b-inline b-comment__form">
                    <input class="b-inline b-comment__input b-cabinet-wall__avitter-avitt-comm-input" type="text">
                    <input class="b-inline b-comment__input-clear b-cabinet-wall__avitter-avitt-clear" type="reset" value="">
                </form>
                <a href="#" class="b-inline b-billet__button b-comment__send">
                    <span class="b-inline b-billet__button-text">Отправить</span>
                </a>
            </div>
        </div>
        *}
    </div>
    {*<a class="b-block b-cabinet-wall__wall-more">Еще комментарии</a>*}
