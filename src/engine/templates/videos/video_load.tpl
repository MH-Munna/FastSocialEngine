<script>
    function load_vi(){
    data={
            'url':$('#vi_url').val(),
            'name':$('#vi_name').val(),
            'text':$('#vi_text').val()
        };
        $('#vi_load').html('<h1>Загрузка видео</h1>');
        $.post('/ajax_html/video_load.php',data,function(a){
            a=$.parseJSON(a);
                    $('#vi_load').html(a.text);
                    update_video_list();
        });
    }
</script>
<div id="vi_load">
<h1>Добавить новое видео</h1>
    <span>Вставьте ссылку с Youtube Например: http://www.youtube.com/watch?v=9bZkp7q19f0</span>
<table>
<tr><td colspan="2"><span style="color: #ff0000" id="vi_error"></span></td></tr>
<tr><td>Ссылка на видео</td><td><input type="text" id="vi_url" placeholder="" onkeyup="get_video_info_by_url('vi_url');" onchange="get_video_info_by_url('vi_url');"></td></tr>
<tr><td>Название видео</td><td><input type="text" id="vi_name"></td></tr>
<tr><td>Описание видео</td><td><textarea id="vi_text"></textarea></td></tr>
<tr><td colspan=2 align="center"><input onclick="load_vi()" type="button" value="Загрузить"></td></tr>
</table>
</div>