<div class="popup-container">
	<!-- Заголовок попапа -->
	<div class="b-popup_header">
		<div class="b-btn m-type-1 m-gray m-right"><a href="#" onclick="app_save('form_app_config');">Сохранить</a></div>
		<h2 class="b-title">Настройки приложения:</h2>		
	</div>

	<!-- Форма с полями -->
	<form id="form_app_config" action="" method="">

	<!-- Начало двух колонок -->
	<div class="b-2col">
		
		<!-- 1 колонка -->
		<div class="b-col m-type1">

			<!-- Секция формы -->
			<dl class="b-popup__form_section">
				<dt class="b-sectitle">Основная информация</dt>
				<dd>
					<div class="b-section__item">
						<label for="app_name">Название</label>
					</div>
					<div class="b-section__item">
						<input class="b-input" type="text" placeholder="Название приложения" name="app_name" id="app_name" value="{$app_config.app_info.app_name}">
						<input class="app_config" id="app_id" type="hidden" name="app_id" value="{$app_config.app_info.id}" />
					</div>
					<div class="b-section__item">
						ID приложения: {$app_config.app_info.client_id}
					</div>
					<div class="b-section__item">
						Секретный ключ: {$app_config.app_info.client_secret}
					</div>
				</dd>
			</dl>

			<!-- Секция формы -->
			<dl class="b-popup__form_section">
				<dt class="b-sectitle">Тип приложения</dt>
				<dd>
					<div class="b-section__item">
						<input class="b-input" type="radio" name="app_type" value="SWF" id="app_type_swf" onchange="app_change_type('swf');" {if $app_config.app_info.app_type eq '0'}checked{/if}>
						<label for="app_type_swf">SWF</label>
					</div>
					<div class="b-section__item">
						<input class="b-input" type="radio" name="app_type" value="iFrame" id="app_type_iframe" onchange="app_change_type('iframe');" {if $app_config.app_info.app_type eq '1'}checked{/if} >
						<label for="app_type_iframe">iFrame</label>
					</div>
					<div class="b-section__item" id="app_config_swf_tab" style="{if $app_config.app_info.app_type != '0'}display: none;{/if}">
						<div class="b-btn m-type-1 m-gray"><a href="#" onclick="$('#upload_swf').click()">Загрузить SWF</a></div>
					</div>
					<div class="b-section__item" id="app_config_iframe_tab" style="{if $app_config.app_info.app_type != '1'}display: none;{/if}">
						URL: <input class="b-input" type="text" placeholder="URL iFrame" name="app_url" value="{$app_config.app_info.app_iframe_url}">
					</div>					
				</dd>
			</dl>
		</div>

		<!-- 2 колонка -->
		<div class="b-col m-type1">

			<!-- Секция формы -->
			<dl class="b-popup__form_section">
				<dt class="b-sectitle">Настройки платежа</dt>
				<dd><div class="b-section__item">
						<label for="app_fburl">FeedBack URL:</label>
					</div>
					<div class="b-section__item">
						<input class="b-input" type="text" value="{$app_config.app_info.fburl}" placeholder="http://example.com/avatoria.php" name="app_fburl">
					</div>
				</dd>
			</dl>
		</div>
	</div>
    </form>
	<!-- Блок загрузки файла swf -->
	 <div class="b-hidden_area" id="app_config_swf_tab" style="display: none;">
        <p>Загрузка SWF</p>
        <div class="upload-form">
            <form target="hiddenframe" enctype="multipart/form-data" action="/uploads/upload_app_swf.php" method="post" name="uploadform">
                <input type="hidden" name="app_id" value="{$app_config.app_info.id}" />
                <input id="upload_swf" type="file" name="upload_swf" onchange="document.uploadform.submit();" />
                <iframe name="hiddenframe" class="hiddenframe" style="display: none;"></iframe>
            </form>
        </div>
        <div class="upload-files" id="upload-files">
        </div>
        <div class="console" id="console">
        </div>
    </div>

</div>