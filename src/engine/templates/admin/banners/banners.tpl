{include file='admin/header.tpl'}
<p><a href="/adm/banners/banners_actions.php?action=add">Создать новый баннер</a></p>

<form action="/adm/banners/banners.php" method="get">
    <p>
        <label for="i_slide">Тип банера</label>
        <select name="i_slide">
            <option value="0" {if $filters.i_slide eq 0}selected="true" {/if}>не выбрано</option>
            <option value="1" {if $filters.i_slide eq 1}selected="true" {/if}>Обычные банеры</option>
            <option value="2" {if $filters.i_slide eq 2}selected="true" {/if}>Слайды</option>
        </select>
    </p>
    <p>
        <label for="city">Город:</label>
        <input type="text" name="city" value="{$filters.geo.city}" />
    </p>
    <p>
        <input type="submit" value="показать"/>
    </p>
</form>

<table border="1">
    <tr>
        <td>id</td>
        <td>ts_start</td>
        <td>ts_stop</td>
        <td>vc_url_content</td>
        <td>vc_type</td>
        <td>i_view</td>
        <td>i_click</td>
        <td>vc_redirect_url</td>
        <td>fk_ban_pos</td>
        <td>vc_geo</td>
        <td>i_geo_level</td>
        <td>i_active</td>
        <td>action</td>
        <td>action</td>
    </tr>
{foreach item=con from=$banners}
    <tr>
        <td>{$con.id}</td>
        <td>{$con.ts_start}</td>
        <td>{$con.ts_stop}</td>
        <td>
            {if $con.vc_url_content eq ''}
                <p style="color: #ff0000">не загружено</p>
                {else}
                <p style="color: #008000">загружено</p>
            {/if}
        </td>
        <td>{$con.vc_type}</td>
        <td>{$con.i_view}</td>
        <td>{$con.i_click}</td>
        <td>{$con.vc_redirect_url}</td>
        <td>{$con.fk_ban_pos}</td>
        <td>{$con.vc_geo}</td>
        <td>{$con.i_geo_level}</td>
        <td>{$con.i_active}</td>
        <td>
            <a href="/adm/banners/banner_edit.php?id={$con.id}">[EDIT]</a>
        </td>
        <td>
            <a href="/adm/banners/banners_actions.php?action=delete&ban_id={$con.id}" onclick="return confirm('Удалить объявление?');">[DELETE]</a>
        </td>
    </tr>
{foreachelse}
{/foreach}
</table>
{include file='admin/footer.tpl'}