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

    <div class='b-cabinet-wall__photo-wrap'>
        {if $opened_profile eq $session_uid}
            <div class="b-inline b-cabinet-wall__groups-add-wrap"  onclick="click_to_upload(); return false;">
                <a class="b-inline b-cabinet__chat-contact-list-button b-cabinet-wall__groups-add">
                    <span class="b-inline b-cabinet-wall__groups-add-plus"></span>
                    <span class="b-inline b-participants__button-text b-cabinet-wall__groups-text">Загрузить фотографии</span>
                </a>
            </div>
        {/if}
        <span class='b-inline b-cabinet-wall__photo-header b-cabinet-wall__photo-header_active'>
            <a href='#' onclick="update_photo_albums_list({$opened_profile}); return false;" class='b-cabinet-wall__photo-header'>Фотоальбомы</a>
            <span class='b-cabinet-wall__album-name'>{$albumName}

                {if $session_uid eq $opened_profile}
                    <span>
                    <a href="#" onclick="set_name_photo_album({$albumID}, '{$albumName}'); return false;" title="переименовать альбом">[переименовать]</a>
                    <a href="#" onclick="del_photo_album({$albumID}); return false;" title="удалить альбом">[удалить]</a>
                    </span>
                {/if}

                <span class='b-cabinet-wall__photo-count'>({$photos_count} {$photos_count|plural:'фотография':'фотографии':'фотографий'})
                </span>
            </span>
        </span>
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

    <div class='b-cabinet-wall__photos'>
        {foreach item=con from=$photos}
        <a href='#' onclick="open_photo({$con.id}); return false;" class='b-inline b-cabinet-wall__photo_small'>
            <img alt="" src="{$con.vc_url100x100}" />
            <div class='b-cabinet-wall__photo-overlay'></div>
        </a>
        {/foreach}
    </div>



