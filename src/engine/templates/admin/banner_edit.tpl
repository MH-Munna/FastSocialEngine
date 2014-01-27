{include file='admin/header.tpl'}
<table>
    <tr>
    <td>
<form action="banners_actions.php" method="post">
    <input type="hidden" name="action" value="edit_banner" />
    <input type="hidden" name="ban[id]" value="{$banner.id}" />
    <table>

        <tr>
            <td>id</td>
            <td>{$banner.id}</td>
        </tr>
        <tr>
            <td>Старт показа банера:</td>
            <td><input type="text" name="ban[ts_start]" value="{$banner.ts_start}" /></td>
        </tr>
        <tr>
            <td>Остановка показа банера:</td>
            <td><input type="text" name="ban[ts_stop]" value="{$banner.ts_stop}" /></td>
        </tr>
        <tr>
            <td>Изображение:</td>
            <td>
                {if $banner.vc_type eq 'jpg'}
                    <img src="{$banner.vc_url_content}" />
                {/if}
                {if $banner.vc_type eq 'png'}
                    <img src="{$banner.vc_url_content}" />
                {/if}
                {if $banner.vc_type eq 'gif'}
                    <img src="{$banner.vc_url_content}" />
                {/if}
            </td>
        </tr>

        <tr>
            <td>Тип изображения:</td>
            <td><input type="text" name="ban[vc_type]" value="{$banner.vc_type}" /></td>
        </tr>
        <tr>
            <td>Счетчик просмотров:</td>
            <td><input type="text" name="ban[i_view]" value="{$banner.i_view}" /></td>
        </tr>
        <tr>
            <td>Счетчик кликов:</td>
            <td><input type="text" name="ban[i_click]" value="{$banner.i_click}" /></td>
        </tr>
        <tr>
            <td>Ссылка банера:</td>
            <td><input type="text" name="ban[vc_redirect_url]" value="{$banner.vc_redirect_url}" /></td>
        </tr>
        <tr>
            <td>ID места где расположен баннер:</td>
            <td><input type="text" name="ban[fk_ban_pos]" value="{$banner.fk_ban_pos}" /></td>
        </tr>
        <tr>
            <td>Геопривязка:</td>
            <td><input type="text" name="ban[vc_geo]" value="{$banner.vc_geo}" /></td>
        </tr>
        <tr>
            <td>Глубина геопривязки:</td>
            <td><input type="text" name="ban[i_geo_level]" value="{$banner.i_geo_level}" /></td>
        </tr>
        <tr>
            <td>Активность (1 - да, 0 - нет):</td>
            <td><input type="text" name="ban[i_active]" value="{$banner.i_active}" /></td>
        </tr>
    </table>

    <input type="submit">
</form>
    </td>
    <td>
        <form enctype="multipart/form-data" action="banners_actions.php" method="POST">
        <input type="hidden" name="ban_id" value="{$banner.id}" />
        <input type="hidden" name="action" value="upload_banner" />
        <h2>Загрузить баннер:</h2>
        <p><input type="file" name="ban" /><input type="submit" value="upload"/></p>
    </form>
        <p><a href="banners_actions.php?action=del_image&ban_id={$banner.id}">Удалить изображение</a></p>
    </td>
    </tr>
</table>
{include file='admin/footer.tpl'}