<script src="/js/photo.js" type="text/javascript"></script>
{if $session_uid eq $opened_profile}
<script>
    function start_upload_files(){
        $('#console')[0].innerHTML = 'Ждите...';
        document.uploadform.submit();
    }
    function click_to_upload(){
        if (window.myProfileID == window.viewProfileID){
            document.getElementById('upload_images').click();
        }
        return false;
    }

</script>
{/if}
    <div class="filtr">
        <a href="#" onclick="select_tab('photo'); return false;">Фотоальбомы</a> - <a href="#" onclick="return false;">{$albumName}</a>
        {if $session_uid eq $opened_profile}
            <div class="new" onclick="click_to_upload(); return false;">
                <span class="plus"></span>
                <span class="btn-text">Добавить фотографии</span>
                <span class="corner"></span>
            </div>
        {/if}
    </div>

{if $session_uid eq $opened_profile}
<div class="upload-form" style="display: none;">
    <form target="hiddenframe" enctype="multipart/form-data" action="/uploads/upload_images.php" method="post" name="uploadform">
        <input type="hidden" name="album_id" value="{$albumID}" />
        <input type="file" id="upload_images" name="upload_images[]" multiple="multiple" onchange="start_upload_files();" />
        <iframe name="hiddenframe" class="hiddenframe"></iframe>
    </form>
</div>
<div class="upload-files" id="upload-files">
</div>
<div class="console" id="console">
</div>
{/if}


<div id="photo_albums_div">
{foreach item=con from=$photos}

    <li class="photoalbum" id="photo_{$con.id}">
        <a href="{$con.vc_url}" onclick="open_photo({$con.id}); return false;">
        <img onclick="open_photo({$con.id}); return false;" src="{$con.vc_url199x139}">
         <span class="close"></span>
        {*<span class="photoalbum_label">*}
            {*<span class="photoalbum_title">без названия</span>*}
            {*<span class="photo_quantity">10 фотографий</span>*}
        {*</span>*}
        </a>
        {if $session_uid eq $opened_profile}<a href="#" onclick="del_photo({$con.id}); return false;"  class="photoalbum_close"></a>{/if}
    </li>

{*<div id="photo_{$con.id}" style="float: left;">*}
    {*<a href="{$con.vc_url}" onclick="open_photo({$con.id}); return false;"><img src="{$con.vc_url100x100}" /></a>*}
{*</div>*}
    {foreachelse}
    {*Ничего не найдено*}
{/foreach}
</div>


{*
<li class="photoalbum">
            <a onclick="open_photo_album(46); return false;" href="#">
                <img width="199" height="139" alt="" src="http://pics.avatoria.ru/1886/yWqy9-gEAQA199x139.jpg">
                <span class="close"></span>
                <span class="photoalbum_label">
                    <span class="photoalbum_title">без названия</span>
                    <span class="photo_quantity">10 фотографий</span>
                </span>
            </a>
            <a class="photoalbum_close" onclick="del_photo_album(46); return false;" href="#"></a>        </li>
*}