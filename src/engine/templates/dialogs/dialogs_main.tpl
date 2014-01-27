<div class="friend-chat-wrap">
    <div class="friend-list-wrap">
        <div class="leftColumn">
            <a class="button-create" href="#">Создать диалог</a>
            <ul class="friend-list">
                {foreach from=$friends item=item key=key}
                    {if $item.id!=$profile.id}
                        <li class="friend-list-item active" onclick="start_chat({$item.id})"><a href="#" onclick="return false">{$item.ch_fname} {$item.ch_lname}</a>
                        </li>
                    {/if}
                {/foreach}
            </ul>
        </div>
        <div class="rightColumn friend-chat">
            <div class="friend-chat-member-wrap">
                <div class="friend-chat-member-list">
                    <ul class="friend-chat-members">
                        <li class="friend-chat-member"><a href="#"><img src="/images/profile/dialog_img-1.jpg" alt=""/></a>
                        </li>
                        <li class="friend-chat-member"><a href="#"><img src="/images/profile/dialog_img-2.jpg" alt=""/></a>
                        </li>
                        <li class="friend-chat-member"><a href="#"><img src="/images/profile/dialog_img-3.jpg" alt=""/></a>
                        </li>
                        <li class="friend-chat-member"><a href="#"><img src="/images/profile/dialog_img-4.jpg" alt=""/></a>
                        </li>
                        <li class="friend-chat-member"><a href="#"><img src="/images/profile/dialog_img-5.jpg" alt=""/></a>
                        </li>
                        <li class="friend-chat-member"><a href="#"><img src="/images/profile/dialog_img-6.jpg" alt=""/></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="friend-chat-sorting">
                <span class="chat-sorting-label">Показать за:</span>
                <ul class="button">
                    <li class="active">1 день</li>
                    <li>3 дня</li>
                    <li>7 дней</li>
                    <li>месяц</li>
                    <li>полгода</li>
                    <li>год</li>
                </ul>
                <a class="chat-settings" href=""></a>
            </div>
            <div class="friend-chat-inner">
                <ul class="chat-message-list">
                </ul>
            </div>
        </div>
    </div>
    <div class="add_comment">
        <div class="slide">
            <a href=""><img src="{$user_info.avatar_url_50x50}" alt="" height="40" width="40"></a>
        </div>
        <div class="chat-textarea">
            <div class="tab"><img src="/images/profile/panel.png"></div>
            <div class="emo_get"></div>
            <div contenteditable="true" class="text_to_message" placeholder="Оставьте свое сообщение"></div>
            <button class="send" id="send_mess">Отправить</button>
            <div class="emo_div">
                {section name="id" loop=31}
                    <div class="emos smil_{$smarty.section.id.index}"></div>
                {/section}
            </div>
        </div>
        <div class="clr"></div>
    </div>
</div>