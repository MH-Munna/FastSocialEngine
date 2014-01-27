{foreach item=con from=$d.dialogs}
    <a class="b-block b-cabinet-wall__chat-contact-list-item" onclick="dialog_update_message_list({$con.id}); return false;">{$con.title}</a>
    {foreachelse}
{/foreach}