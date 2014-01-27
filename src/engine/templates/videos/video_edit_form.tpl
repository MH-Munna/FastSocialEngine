<div id="vi_load">
    <h1>Редактирование</h1>
    <p>
        <img src="{$video.sv.img}" alt="" />
    </p>
    <table>
        <tr><td colspan="2"><span>Отредактируйте название и описание видеоролика и нажмите "Сохранить"</span></td></tr>
        <tr><td colspan="2"><span style="color: #ff0000" id="vi_error"></span></td></tr>
        <tr><td>Название видео</td><td><input type="text" id="vi_name" value="{$video.vc_name}"></td></tr>
        <tr><td>Описание видео</td><td><textarea id="vi_text" cols="60" rows="10">{$video.text_description}</textarea></td></tr>
        <tr><td colspan=2 align="center"><input onclick="return save_video_info({$video.id});" type="button" value="Сохранить"></td></tr>
    </table>
</div>