<header class="g-out b-block l-header l-header-groups">
<div class="l-base b-header g-out">
<a href="{$i.base_url}" onclick="return open_profile({$u.info.id});" class="b-inline b-header__logo"></a>
<a href="#" class="b-inline b-header__stiker"></a>
<a href="#" class="g-out b-inline b-header__email">{*<span class="b-header__email-mails">12</span>*}
</a><a href="#" class="b-inline b-header__present">
</a>
    <div class="g-out b-inline b-header__wallet" onclick="return open_cache_form();">
    <div class="g-out b-inline b-header__wallet-case_1">
        <a href="#" class="b-inline b-header__wallet-link b-header__wallet-link_1">{$u.info.d_money_av}</a>
    </div><div class="g-out b-inline b-header__wallet-case_2">
        <a href="#" class="b-inline b-header__wallet-link b-header__wallet-link_2 b-header__wallet-link_ticket">{$u.info.d_money_bonus}</a>
    </div><div class="g-out b-inline b-header__wallet-case_3">
        <a href="#" class="b-inline b-header__wallet-link b-header__wallet-link_3 b-header__wallet-link_ticket">{$u.info.d_money_check}</a>
    </div><div class="b-header__wallet-new-check">Новые чеки</div>
</div>
<a href="#" onclick="get_my_config(); return false;" class="b-inline b-header__settings"></a>
<a href="{$i.base_url}/login/logout.php" class="b-inline b-header__exit"></a>
<a href="#" class="b-inline b-header__rus"></a>
<a href="{$i.base_url}/addition/auto/" class="b-inline b-header__car"></a>

<figure class="b-newest">
    <div class="b-newest__wrap">
        <a class="b-inline b-cabinet-drag-and-drop__link b-cabinet-drag-and-drop__link_fix b-newest__fix"><img alt="Fix" class="b-block" height="15" src="{$i.base_url}/assets/cabinet/drag-and-drop/fix.png" width="14" /></a>
        <h2 class="b-newest__header">Сообшение</h2>
        <a class="b-newest__close"></a>
        <div class="b-block b-cabinet-wall__chat-post-wrap">
            <a href="#" class="b-inline b-title__border"><img alt="User 0" class="b-block b-title__border-img" height="40" src="{$i.base_url}/assets/groups/img/user/user-0.jpg" width="40" /></a>
            <div class="b-inline b-cabinet-wall__chat-post">
                <a href="#" class="b-inline b-cabinet-wall__chat-post-author">Имя Фамилия</a>
                <span class="b-inline b-cabinet-wall__chat-post-time">15:35</span>
                <p class="b-block b-cabinet-wall__chat-post-text">
                  &laquo;Ингосстрах&raquo; и&nbsp;пул страховщиков застраховал запуск 
                  ракеты-носителя &laquo;Союз-ФГ&raquo; с&nbsp;кораблем &laquo;Союз ТМА-11М&raquo;
                </p>
            </div>
            <span class="b-inline b-cabinet-wall__chat-post-data">1 августа</span>
        </div>
        <div class="b-block b-newest__ckeditor">
            <a href="#" class="b-inline b-title__border"><img alt="User 5" class="b-block b-title__border-img" height="40" src="{$i.base_url}/assets/groups/img/user/user-5.jpg" width="40" /></a>
            <textarea class='b-inline ckeditor' id='ckeditor'></textarea>
            <a class="b-block b-cabinet__chat-contact-list-button b-cabinet-wall__chat-contact-list-button b-cabinet__ckeditor-button">
               <span class="b-inline b-participants__button-text b-cabinet-wall__chat-contact-list-button-text">Отправить</span>
            </a>
        </div>
    </div>
</figure>

<figure class="b-present__cover">
    <div class="b-present">
        <h2 class="b-present__header">Подарить подарок</h2>
        <a class="b-present__close"></a>
        <span class="b-center b-present__info">Стоимость одного подарка составляет 1 Авит</span>
        <div class="b-block b-present__wrap">
            <a href="#" class="b-inline b-present__item" id="present-1"></a>
            <a href="#" class="b-inline b-present__item" id="present-2"></a>
            <a href="#" class="b-inline b-present__item" id="present-3"></a>
            <a href="#" class="b-inline b-present__item" id="present-4"></a>
            <a href="#" class="b-inline b-present__item" id="present-5"></a>
            <a href="#" class="b-inline b-present__item" id="present-6"></a>
            <a href="#" class="b-inline b-present__item" id="present-7"></a>
            <a href="#" class="b-inline b-present__item" id="present-8"></a>
            <a href="#" class="b-inline b-present__item" id="present-9"></a>
            <a href="#" class="b-inline b-present__item" id="present-10"></a>
            <a href="#" class="b-inline b-present__item" id="present-11"></a>
            <a href="#" class="b-inline b-present__item" id="present-12"></a>
            <a href="#" class="b-inline b-present__item" id="present-13"></a>
            <a href="#" class="b-inline b-present__item" id="present-14"></a>
            <a href="#" class="b-inline b-present__item" id="present-15"></a>
            <a href="#" class="b-inline b-present__item" id="present-16"></a>
        </div>
    </div>
</figure>

<figure class="g-out b-present-new__cover">
    <div class="b-present-new">
        <a class="b-present-new__close"></a>
        <div class="g-out b-inline b-stickers-new__color">
            <span class="b-block b-stickers-new__color-header">Подарок</span>
            <a href="#" class="b-inline b-present-new__item" id="present-1"></a>
            <span class="b-block b-stickers-new__whom">Кому подарить</span>
        </div>
        <div class="b-inline b-stickers-new__message">
            <span class="b-block b-stickers-new__color-header">Добавить сообщение</span>
            <form class="b-block b-stickers-new__form">
                <textarea class="b-block b-stickers-new__form-textarea" maxlength="70" form="b-stickers-new__form"></textarea>
                <input class="b-block b-stickers-new__form-button" type="submit" value="Отправить" form="b-stickers-new__form">
            </form>
        </div>
        <div class="g-out b-block">
            <select data-placeholder=" " class="chosen-select" multiple style="width:490px;" tabindex="4">
                <option value=""></option>
                <option value="United States" data-img='{$i.base_url}/assets/groups/img/user/user-0.jpg'>Имя Фамилия</option>
                <option value="United Kingdom" data-img={$i.base_url}/assets/groups/img/user/user-2.jpg'>Имя Фамилия</option>
                <option value="Afghanistan" data-img={$i.base_url}/assets/groups/img/user/user-3.jpg'>Имя Фамилия</option>
                <option value="Aland Islands" data-img={$i.base_url}/assets/groups/img/user/user-1.jpg'>Имя Фамилия</option>
                <option value="Albania" data-img={$i.base_url}/assets/groups/img/user/user-4.jpg'>Имя Фамилия</option>
                <option value="Algeria" data-img={$i.base_url}/assets/groups/img/user/user-6.jpg'>Имя Фамилия</option>
                <option value="American Samoa" data-img={$i.base_url}/assets/groups/img/user/user-5.jpg'>Имя Фамилия</option>
                <option value="Andorra" data-img={$i.base_url}/assets/groups/img/user/user-0.jpg'>Имя Фамилия</option>
                <option value="Angola" data-img={$i.base_url}/assets/groups/img/user/user-2.jpg'>Имя Фамилия</option>
                <option value="Anguilla" data-img={$i.base_url}/assets/groups/img/user/user-6.jpg'>Имя Фамилия</option>
                <option value="Antarctica" data-img={$i.base_url}/assets/groups/img/user/user-7.jpg'>Имя Фамилия</option>
                <option value="Antigua and Barbuda" data-img={$i.base_url}/assets/groups/img/user/user-1.jpg'>Имя Фамилия</option>
                <option value="Argentina" data-img={$i.base_url}/assets/groups/img/user/user-4.jpg'>Имя Фамилия</option>
                <option value="Armenia" data-img={$i.base_url}/assets/groups/img/user/user-3.jpg'>Имя Фамилия</option>
                <option value="Aruba" data-img={$i.base_url}/assets/groups/img/user/user-6.jpg'>Имя Фамилия</option>
                <option value="Australia" data-img={$i.base_url}/assets/groups/img/user/user-2.jpg'>Имя Фамилия</option>
                <option value="Austria" data-img={$i.base_url}/assets/groups/img/user/user-0.jpg'>Имя Фамилия</option>
                <option value="Azerbaijan" data-img={$i.base_url}/assets/groups/img/user/user-5.jpg'>Имя Фамилия</option>
                <option value="Bahamas" data-img={$i.base_url}/assets/groups/img/user/user-1.jpg'>Имя Фамилия</option>
                <option value="Bahrain" data-img={$i.base_url}/assets/groups/img/user/user-6.jpg'>Имя Фамилия</option>
            </select>
        </div>
    </div>
</figure>

<figure class="g-out b-stickers-new">
    <a class="b-stickers-new__close"></a>
    <div class="g-out b-inline b-stickers-new__color">
        <span class="b-block b-stickers-new__color-header">Стикер</span>
        <div class="g-out b-block b-stickers-new__color-choice">
            <div class="b-sticker__red" id="sticker-color"></div>
            <div class="b-inline b-stickers-new__color-item b-stickers-new__color-item_active" id="b-stickers-new__color-item_red"></div>
            <div class="b-inline b-stickers-new__color-item" id="b-stickers-new__color-item_brown"></div>
            <div class="b-inline b-stickers-new__color-item" id="b-stickers-new__color-item_blue"></div>
            <div class="b-inline b-stickers-new__color-item" id="b-stickers-new__color-item_orange"></div>
            <div class="b-inline b-stickers-new__color-item" id="b-stickers-new__color-item_green"></div>
        </div>
        <span class="b-block b-stickers-new__whom">Кому подарить</span>
    </div>
    <div class="b-inline b-stickers-new__message">
        <span class="b-block b-stickers-new__color-header">Сообщение</span>
        <form class="b-block b-stickers-new__form">
            <textarea class="b-block b-stickers-new__form-textarea" maxlength="70" form="b-stickers-new__form"></textarea>
            <input class="b-block b-stickers-new__form-button" type="submit" value="Отправить" form="b-stickers-new__form">
        </form>
    </div>
    <div class="g-out b-block">
        <select data-placeholder=" " class="chosen-select" multiple style="width:490px;" tabindex="4">
            <option value=""></option>
            <option value="United States" data-img={$i.base_url}/assets/groups/img/user/user-0.jpg'>Имя Фамилия</option>
            <option value="United Kingdom" data-img={$i.base_url}/assets/groups/img/user/user-2.jpg'>Имя Фамилия</option>
            <option value="Afghanistan" data-img={$i.base_url}/assets/groups/img/user/user-3.jpg'>Имя Фамилия</option>
            <option value="Aland Islands" data-img={$i.base_url}/assets/groups/img/user/user-1.jpg'>Имя Фамилия</option>
            <option value="Albania" data-img={$i.base_url}/assets/groups/img/user/user-4.jpg'>Имя Фамилия</option>
            <option value="Algeria" data-img={$i.base_url}/assets/groups/img/user/user-6.jpg'>Имя Фамилия</option>
            <option value="American Samoa" data-img={$i.base_url}/assets/groups/img/user/user-5.jpg'>Имя Фамилия</option>
            <option value="Andorra" data-img={$i.base_url}/assets/groups/img/user/user-0.jpg'>Имя Фамилия</option>
            <option value="Angola" data-img={$i.base_url}/assets/groups/img/user/user-2.jpg'>Имя Фамилия</option>
            <option value="Anguilla" data-img={$i.base_url}/assets/groups/img/user/user-6.jpg'>Имя Фамилия</option>
            <option value="Antarctica" data-img={$i.base_url}/assets/groups/img/user/user-7.jpg'>Имя Фамилия</option>
            <option value="Antigua and Barbuda" data-img={$i.base_url}/assets/groups/img/user/user-1.jpg'>Имя Фамилия</option>
            <option value="Argentina" data-img={$i.base_url}/assets/groups/img/user/user-4.jpg'>Имя Фамилия</option>
            <option value="Armenia" data-img={$i.base_url}/assets/groups/img/user/user-3.jpg'>Имя Фамилия</option>
            <option value="Aruba" data-img={$i.base_url}/assets/groups/img/user/user-6.jpg'>Имя Фамилия</option>
            <option value="Australia" data-img={$i.base_url}/assets/groups/img/user/user-2.jpg'>Имя Фамилия</option>
            <option value="Austria" data-img={$i.base_url}/assets/groups/img/user/user-0.jpg'>Имя Фамилия</option>
            <option value="Azerbaijan" data-img={$i.base_url}/assets/groups/img/user/user-5.jpg'>Имя Фамилия</option>
            <option value="Bahamas" data-img={$i.base_url}/assets/groups/img/user/user-1.jpg'>Имя Фамилия</option>
            <option value="Bahrain" data-img={$i.base_url}/assets/groups/img/user/user-6.jpg'>Имя Фамилия</option>
        </select>
    </div>
</figure>

<figure class="b-cabinet-form-wrap" id="cache_box">
    <div>
        Load...
    </div>
</figure>

</div>
</header>
