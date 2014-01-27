<script>
    window.activeDialogId = {$d.selected_dialog};
</script>
<div class="b-block b-cabinet-wall__wrap b-cabinet-wall__wrap_chat">
    <div class="b-inline b-cabinet-wall__chat-contact-list">
        <a class="b-inline b-cabinet__chat-contact-list-button b-cabinet-wall__chat-contact-list-button" onclick="dialog_start({$op.info.id}); return false;">
            <span class="b-inline b-participants__button-text b-cabinet-wall__chat-contact-list-button-text">Создать диалог</span>
        </a>
        <div class="b-block b-cabinet__chat-contact-list-wrap" id="chat_tab_dialog_list">
            {include file="dialogs/dialogs_list.tpl"}
        </div>
    </div><!--
--><div class="b-inline b-cabinet-wall__chat_left">
        {*<div class="b-block b-cabinet-wall__chat-list-chat">*}
            {*<a href="#" class="b-inline b-title__border b-title__user"><img alt="User 0" class="b-block b-title__border-img" height="50" src="{$i.base_url}/assets/groups/img/user/user-0.jpg" width="50" /></a>*}
            {*<a href="#" class="b-inline b-title__border b-title__user"><img alt="User 1" class="b-block b-title__border-img" height="50" src="{$i.base_url}/assets/groups/img/user/user-1.jpg" width="50" /></a>*}
            {*<a href="#" class="b-inline b-title__border b-title__user"><img alt="User 2" class="b-block b-title__border-img" height="50" src="{$i.base_url}/assets/groups/img/user/user-2.jpg" width="50" /></a>*}
            {*<a href="#" class="b-inline b-title__border b-title__user"><img alt="User 3" class="b-block b-title__border-img" height="50" src="{$i.base_url}/assets/groups/img/user/user-3.jpg" width="50" /></a>*}
            {*<a href="#" class="b-inline b-title__border b-title__user"><img alt="User 4" class="b-block b-title__border-img" height="50" src="{$i.base_url}/assets/groups/img/user/user-4.jpg" width="50" /></a>*}
            {*<a href="#" class="b-inline b-title__border b-title__user"><img alt="User 5" class="b-block b-title__border-img" height="50" src="{$i.base_url}/assets/groups/img/user/user-5.jpg" width="50" /></a>*}
            {*<a href="#" class="b-inline b-title__border b-title__user"><img alt="User 6" class="b-block b-title__border-img" height="50" src="{$i.base_url}/assets/groups/img/user/user-6.jpg" width="50" /></a>*}
        {*</div>*}
        <div class="b-block b-cabinet-wall__chat-show-wrap g-out">
            {*<span class="b-inline b-cabinet-wall__chat-show">Показать за:</span>*}
            {*<a class="b-inline b-cabinet__wall-button b-cabinet-wall__chat-show-button"><span class="b-block b-participants__button-text b-cabinet-wall__chat-show-button-text">1 день</span></a>*}
            {*<a class="b-inline b-cabinet__wall-button b-cabinet-wall__chat-show-button"><span class="b-block b-participants__button-text b-cabinet-wall__chat-show-button-text">3 дня</span></a>*}
            {*<a class="b-inline b-cabinet__wall-button b-cabinet-wall__chat-show-button"><span class="b-block b-participants__button-text b-cabinet-wall__chat-show-button-text">7 дней</span></a>*}
            {*<a class="b-inline b-cabinet__wall-button b-cabinet-wall__chat-show-button"><span class="b-block b-participants__button-text b-cabinet-wall__chat-show-button-text">месяц</span></a>*}
            {*<a class="b-inline b-cabinet__wall-button b-cabinet-wall__chat-show-button"><span class="b-block b-participants__button-text b-cabinet-wall__chat-show-button-text">полгода</span></a>*}
            {*<a class="b-inline b-cabinet__wall-button b-cabinet-wall__chat-show-button"><span class="b-block b-participants__button-text b-cabinet-wall__chat-show-button-text">год</span></a>*}
            {*<a href="#" class="b-inline b-cabinet-wall__chat-show-setttings"></a>*}
        </div>
        <div class="b-block b-cabinet-wall__chat-cover" id="chat_tab_messages_list">
            {include file='dialogs/messages.tpl'}
        </div>
        <div class="b-block b-cabinet__ckeditor">
            <a href="#" class="b-inline b-title__border"><img alt="User 5" class="b-block b-title__border-img" height="40" src="{$u.info.avatar_url50x50}" width="40" /></a>
            <textarea class='b-inline ckeditor chat_tab_textarea_send_message' id='ckeditor_chat'></textarea>
            <a class="b-block b-cabinet__chat-contact-list-button b-cabinet-wall__chat-contact-list-button b-cabinet__ckeditor-button">
                <span class="b-inline b-participants__button-text b-cabinet-wall__chat-contact-list-button-text" onclick="chat_tab_send_click('ckeditor_chat', window.activeDialogId); return false;">Отправить</span>
            </a>
        </div>
    </div>
</div>