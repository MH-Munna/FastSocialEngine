{*<h1>{$vi.name}</h1>*}
{*<div id="message_del_add">*}
    {*{if $get}<div onclick="$('#message_del_add').load('/ajax_html/video_get?delete=1&id={$vi.id}')">Удалить видео из коллекции</div>*}
        {*{else}*}
    {*<div onclick="$('#message_del_add').load('/ajax_html/video_get?add=1&id={$vi.id}')">Добавить видео в коллекцию</div>*}
    {*{/if}*}
{*</div>*}

{*<p>{$vi.text}</p>*}
{*{include file="comments/com.tpl" id=$vi.id type='video-' salt=$opened_profile}*}



<a class="b-photo-popup__close" onclick="photo_popup_close(); return false;"></a>
<div class='b-photo-popup__wrap'>
    {*<span class='b-inline b-photo-popup__header'>{$photo_info.position_photo} / {$photo_info.count_photos}</span>*}
    <span class='b-inline b-photo-popup__header'>{$video.vc_name}</span>

</div>
<div class="b-block b-photo-popup__image">
    {*<a href="" class="b-cabinet-wall__avitter-avitt-link" id="link-2"></a>*}
    {*<a href="#" onclick="del_photo({$video.id}); return false;" class="b-cabinet-wall__avitter-avitt-link" id="link-3"></a>*}
    <iframe style="overflow:none;" width="640" height="550" src="{$video.sv.url}"></iframe>
</div>
<div class='b-inline b-photo-popup__name-wrap'>
    <div class='b-photo-popup__name'>{$video.text_description}</div>
    <div class='b-photo-popup__date'>{$video.sv.ts}</div>

    {if $u.info.id eq $op.info.id}
        <a href='#' onclick="return edit_video({$video.id});" class='b-photo-popup__link'>Редактировать</a>
        <a href='#' onclick="return delete_video({$video.id});" class='b-photo-popup__link'>Удалить</a>
    {else}
        <span class="span_copy_video_{$video.id}"><a href='#' onclick="return copy_video({$video.id})" class='b-photo-popup__link'>Добавить к себе в видеозаписи</a></span>
        <a href='#' onclick="return false;" class='b-photo-popup__link'>Пожаловаться</a>
    {/if}


</div><!--
  --><div class='b-inline b-photo-popup__likes'>
    <div class='b-inline b-photo-popup__visits'>{$video.sv.view}</div>
    <div class='b-inline b-photo-popup__like'><i class='b-inline b-photo-popup__like-icon'></i> Like <span class='b-inline b-photo-popup__like-count'>41</span></div>
    <div class='b-inline b-photo-popup__gold-like'><i class='b-inline b-photo-popup__gold-like-icon'></i> Golden Like <span class='b-inline b-photo-popup__gold-like-count'>5</span></div>
</div>
{*
    <h3 class='b-photo-popup__sponsors-header'>Спонсоры</h3>
    <div class='b-photo-popup__sponsors'>
        <div class='b-inline b-titlvke__border-wrap b-title__border-wrap_user-post'>
            <a href="#" class="b-inline b-title__border">
                <img alt="User 5" class="b-block b-title__border-img" height="40" src="{$i.base_url}/assets/groups/img/user/user-5.jpg" width="40" />
            </a>
        </div><!--
  --><div class='b-inline b-title__border-wrap b-title__border-wrap_user-post'>
            <a href="#" class="b-inline b-title__border">
                <img alt="User 5" class="b-block b-title__border-img" height="40" src="{$i.base_url}/assets/groups/img/user/user-5.jpg" width="40" />
            </a>
        </div><!--
  --><div class='b-inline b-title__border-wrap b-title__border-wrap_user-post'>
            <a href="#" class="b-inline b-title__border">
                <img alt="User 5" class="b-block b-title__border-img" height="40" src="{$i.base_url}/assets/groups/img/user/user-5.jpg" width="40" />
            </a>
        </div>

        <div class='b-photo-popup__button'>Стать спонсором</div>
    *}
</div>

<h3 class='b-photo-popup__comments-header'>Комментарии</h3>

{include file="comments/com.tpl" id=$video.id type='video-' salt=$opened_profile}

{*<div class="b-block b-cabinet__ckeditor b-cabinet__ckeditor_relative b-cabinet__ckeditor_full">*}
{*<a href="#" class="b-inline b-title__border"><img alt="User 5" class="b-block b-title__border-img" height="40" src="{$i.base_url}/assets/groups/img/user/user-5.jpg" width="40" /></a>*}
{*<textarea class='b-inline ckeditor' id='ckeditor_tmp'></textarea>*}
{*<a class="b-block b-cabinet__chat-contact-list-button b-cabinet-wall__chat-contact-list-button b-cabinet__ckeditor-button"><span class="b-inline b-participants__button-text b-cabinet-wall__chat-contact-list-button-text">Отправить</span></a>*}
{*</div>*}

{*<div class="b-block b-cabinet-wall__avitter-avitt-wrap b-cabinet-wall__avitter-avitt-wrap_photo-popup">*}
{*<a href="#" class="b-inline b-title__border"><img alt="User 7" class="b-block b-title__border-img" height="50" src="{$i.base_url}/assets/groups/img/user/user-7.jpg" width="50" /></a>*}
{*<div class="b-inline b-cabinet-wall__avitter-avitt">*}
{*<a href="#" class="b-block b-cabinet-wall__avitter-avitt-name">Имя Фамилия</a>*}
{*<p class="b-block b-cabinet-wall__avitter-avitt-date-time"><span class="b-inline b-cabinet-wall__avitter-avitt-date">10.03.2013</span> | <span class="b-inline b-cabinet-wall__avitter-avitt-time">15:35</span></p>*}
{*<p class="b-block b-cabinet-wall__avitter-avitt-text">Вращение, несмотря на некоторую погрешность, ортогонально искажает  пирокластический ПИГ, не забывая о том, что интенсивность диссипативных  сил, характеризующаяся величиной коэффициента D, должна лежать...</p>*}
{*<a href="" class="b-cabinet-wall__avitter-avitt-link" id="link-1"></a>*}
{*<a href="" class="b-cabinet-wall__avitter-avitt-link" id="link-2"></a>*}
{*<a href="" class="b-cabinet-wall__avitter-avitt-link" id="link-3"></a>*}
{*</div>*}
{*<div class="b-block b-cabinet-wall__avitter-avitt-comm-wrap">*}
{*<a href="#" class="b-block b-cabinet-wall__avitter-avitt-comm">Комментировать</a>*}
{*<div class="b-inline b-title__border-wrap b-title__border-wrap_comment">*}
{*<a href="#" class="b-block b-title__border"><img alt="User 3" class="b-block b-title__border-img" height="29" src="{$i.base_url}/assets/groups/img/user/user-3.jpg" width="29" /></a>*}
{*</div>*}
{*<form class="b-inline b-comment__form">*}
{*<input class="b-inline b-comment__input b-cabinet-wall__avitter-avitt-comm-input" type="text">*}
{*<input class="b-inline b-comment__input-clear b-cabinet-wall__avitter-avitt-clear" type="reset" value="">*}
{*</form>*}
{*<a href="#" class="b-inline b-billet__button b-comment__send">*}
{*<span class="b-inline b-billet__button-text">Отправить</span>*}
{*</a>*}
{*</div>*}
{*</div>*}

{*<div class="b-block b-cabinet-wall__avitter-avitt-wrap b-cabinet-wall__avitter-avitt-wrap_photo-popup b-cabinet-wall__avitter-avitt-wrap_photo_indent">*}
{*<a href="#" class="b-inline b-title__border"><img alt="User 7" class="b-block b-title__border-img" height="50" src="{$i.base_url}/assets/groups/img/user/user-7.jpg" width="50" /></a>*}
{*<div class="b-inline b-cabinet-wall__avitter-avitt">*}
{*<a href="#" class="b-block b-cabinet-wall__avitter-avitt-name">Имя Фамилия</a>*}
{*<p class="b-block b-cabinet-wall__avitter-avitt-date-time"><span class="b-inline b-cabinet-wall__avitter-avitt-date">10.03.2013</span> | <span class="b-inline b-cabinet-wall__avitter-avitt-time">15:35</span></p>*}
{*<p class="b-block b-cabinet-wall__avitter-avitt-text">Вращение, несмотря на некоторую погрешность, ортогонально искажает  пирокластический ПИГ, не забывая о том, что интенсивность диссипативных  сил, характеризующаяся величиной коэффициента D, должна лежать...</p>*}
{*<a href="" class="b-cabinet-wall__avitter-avitt-link" id="link-1"></a>*}
{*<a href="" class="b-cabinet-wall__avitter-avitt-link" id="link-2"></a>*}
{*<a href="" class="b-cabinet-wall__avitter-avitt-link" id="link-3"></a>*}
{*</div>*}
{*<div class="b-block b-cabinet-wall__avitter-avitt-comm-wrap">*}
{*<a href="#" class="b-block b-cabinet-wall__avitter-avitt-comm">Комментировать</a>*}
{*<div class="b-inline b-title__border-wrap b-title__border-wrap_comment">*}
{*<a href="#" class="b-block b-title__border"><img alt="User 3" class="b-block b-title__border-img" height="29" src="{$i.base_url}/assets/groups/img/user/user-3.jpg" width="29" /></a>*}
{*</div>*}
{*<form class="b-inline b-comment__form">*}
{*<input class="b-inline b-comment__input b-cabinet-wall__avitter-avitt-comm-input" type="text">*}
{*<input class="b-inline b-comment__input-clear b-cabinet-wall__avitter-avitt-clear" type="reset" value="">*}
{*</form>*}
{*<a href="#" class="b-inline b-billet__button b-comment__send">*}
{*<span class="b-inline b-billet__button-text">Отправить</span>*}
{*</a>*}
{*</div>*}
{*</div>*}

