<script>
    function profile_settings_save(){
        $.ajax({
            type: "POST",
            url: '/ajax/save_profile_settings.php',
            dataType: 'json',
            data: $("#form_profile_config").serialize()
        }).success(
                function( msg ){
                    if (msg.result=='ok'){
                        alert('Настройки сохранены');
                    }
                }
        );
    }
</script>


<div class="popup-container">

<!-- Заголовок попапа -->
    <div class="b-popup_header">
        <div class="b-btn m-type-1 m-gray m-right"><a href="#" onclick="profile_settings_save();">Сохранить</a></div>
        <h2 class="b-title">Настройки:</h2>      
    </div>

    <!-- Форма с полями -->
    <form id="form_profile_config" action="" method="">

    <!-- Начало двух колонок -->
    <div class="b-2col">
    <div class="b-col m-type1">

            <!-- Секция формы -->
            <dl class="b-popup__form_section">
                <dt class="b-sectitle">Имя:</dt>
                <dd>
                    <div class="b-section__item">
                        <input class="b-input app_config input_text" id="ch_fname" type="text" placeholder="Имя" name="ch_fname" value="{$user_info.ch_fname}">                       
                    </div>                    
                </dd>
            </dl>
            <dl class="b-popup__form_section">
                <dt class="b-sectitle">Фамилия:</dt>
                <dd>
                    <div class="b-section__item">
                        <input class="b-input app_config input_text" id="ch_lname" type="text" placeholder="Фамилия" name="ch_lname" value="{$user_info.ch_lname}" />                      
                    </div>                    
                </dd>
            </dl>
            <dl class="b-popup__form_section">
                <dt class="b-sectitle">Пол:</dt>
                <dd>
                    <div class="b-section__item">
                        <select name="i_sex">
                        <option value="0" {if $user_info.i_sex==0}selected{/if} >Не указан</option>
                        <option value="2" {if $user_info.i_sex==2}selected{/if} >Мужской</option>
                        <option value="1" {if $user_info.i_sex==1}selected{/if} >Женский</option>
                    </select>                       
                    </div>                    
                </dd>
            </dl>
            <dl class="b-popup__form_section">
                <dt class="b-sectitle">Дата рождения:</dt>
                <dd>
                    <div class="b-section__item">
                        <input class="b-input app_config input_text" id="d_bdate" type="text" name="d_bdate" value="{$user_info.d_bdate}" />                       
                    </div>                    
                </dd>
            </dl>
            <dl class="b-popup__form_section">
                <dt class="b-sectitle">Хобби:</dt>
                <dd>
                    <div class="b-section__item">
                        <input class="b-input app_config input_text" id="ch_hobbi" type="text" name="ch_hobbi" value="{$user_info.ch_hobbi}" />                     
                    </div>                    
                </dd>
            </dl>
            <dl class="b-popup__form_section">
                <dt class="b-sectitle">Мечта:</dt>
                <dd>
                    <div class="b-section__item">
                        <input class="b-input app_config input_text" id="ch_mechta" type="text" name="ch_mechta" value="{$user_info.ch_mechta}" />                    
                    </div>                    
                </dd>
            </dl>
            <dl class="b-popup__form_section">
                <dt class="b-sectitle">Страна:</dt>
                <dd>
                    <div class="b-section__item">
                        <input class="b-input app_config input_text" id="vc_country" type="text" name="vc_country" value="{$user_info.vc_country}" />
                    </div>
                </dd>
            </dl>
            <dl class="b-popup__form_section">
                <dt class="b-sectitle">Город:</dt>
                <dd>
                    <div class="b-section__item">
                        <input class="b-input app_config input_text" id="vc_city" type="text" name="vc_city" value="{$user_info.vc_city}" />
                    </div>
                </dd>
            </dl>
        <dl class="b-popup__form_section">
                <dt class="b-sectitle">Статус:</dt>
                <dd>
                    <div class="b-section__item">
                        <input class="b-input app_config input_text" id="vc_status" type="text" name="vc_status" value="{$user_info.vc_status}" />
                    </div>
                </dd>
            </dl>

            
        </div>
     
</form>
</div>