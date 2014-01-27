<script src="/js/photo.js" type="text/javascript"></script>
<div>
{if $photo_info.i_prev_photo neq '0'}<a href="#" onclick="open_photo({$photo_info.i_prev_photo}); return false">Предыдущее фото</a>{/if}
{if $photo_info.i_next_photo neq '0'}<a href="#" onclick="open_photo({$photo_info.i_next_photo}); return false">Следующее фото</a>{/if}
</div>
<div>
<img {if $photo_info.i_next_photo neq '0'}onclick="open_photo({$photo_info.i_next_photo}); return false"{/if} src="{$photo_info.vc_url600x600}" />
</div>
<div>
    Комментарии:
</div>
<div>
    <form onsubmit="add_comment(this); return false;">
        <input type="hidden" name="photoID" value="{$photo_info.id}"/>
        <textarea name="text"></textarea><br />
        <input type="submit">
    </form>
</div>

<div id="comments_photo_{$photo_info.id}" class="cont">

{foreach item=con from=$photo_comments}
{include file='photo/photo_comment.tpl'}
{foreachelse}
{/foreach}

</div>