
    <div class="b-cabinet-form">
        <h2 class="b-block b-cabinet-form__header">Кошелек</h2>
        <a class="b-cabinet-form__close" onclick="return close_cache_form();"></a>
        <div class="b-block b-cabinet-form__field">
            <div class="b-inline b-cabinet-form__menu">
                <div class="b-block b-cabinet-form__button-wrap">
                    <a href="#" class="b-block b-cabinet-form__button" id="buy"><span class="b-inline b-participants__button-text b-cabinet__right-button-text b-cabinet-form__text b-cabinet-form__text_a">Купить валюту сайта</span></a>
                </div>
                <div class="b-block b-cabinet-form__button-wrap">
                    <a href="#" class="b-block b-cabinet-form__button" id="transfer"><span class="b-inline b-participants__button-text b-cabinet__right-button-text b-cabinet-form__text b-cabinet-form__text_share">Перевод другу</span></a>
                </div>
                <div class="b-block b-cabinet-form__button-wrap">
                    <a href="#" class="b-block b-cabinet-form__button" id="free"><span class="b-inline b-participants__button-text b-cabinet__right-button-text b-cabinet-form__text b-cabinet-form__text_refill">Пополнить счет бесплатно</span></a>
                </div>
            </div><!--
   --><div class="b-inline b-cabinet-form__balance">
                <span class="b-block b-cabinet-form__balance-header">Остаток на счете</span>
                <div class="b-block b-cabinet-form__balance-item">
                    <div class="b-inline b-cabinet-form__balance-item-left b-cabinet-form__balance-item-left_blue">
                        <span class="b-block b-cabinet-form__balance-name b-cabinet-form__balance-name_ava">Авы</span>
                    </div>
                    <span class="b-inline b-cabinet-form__balance_num">{$user_info.d_money_av}</span>
                </div>
                <div class="b-block b-cabinet-form__balance-item">
                    <div class="b-inline b-cabinet-form__balance-item-left b-cabinet-form__balance-item-left_green">
                        <span class="b-block b-cabinet-form__balance-name b-cabinet-form__balance-name_check">Чеки</span>
                    </div>
                    <span class="b-inline b-cabinet-form__balance_num">{$user_info.d_money_check}</span>
                </div>
                <div class="b-block b-cabinet-form__balance-item">
                    <div class="b-inline b-cabinet-form__balance-item-left b-cabinet-form__balance-item-left_orange">
                        <span class="b-block b-cabinet-form__balance-name b-cabinet-form__balance-name_bilet">Билеты</span>
                    </div>
                    <span class="b-inline b-cabinet-form__balance_num">{$user_info.d_money_bonus}</span>
                </div>
                <div class="b-block b-cabinet-form__balance-item">
                    <div class="b-inline b-cabinet-form__balance-item-left b-cabinet-form__balance-item-left_lilac">
                        <span class="b-block b-cabinet-form__balance-name b-cabinet-form__balance-name_prize">Призы</span>
                    </div>
                    <span class="b-inline b-cabinet-form__balance_num">0</span>
                </div>
            </div>
            <div class="b-inline b-cabinet-form__unpaid">
                <span class="b-block b-cabinet-form__unpaid-header">Неопалаченные товары</span>
                <form class="b-block b-cabinet-form__unpaid-form">
                    <div class="b-block b-cabinet-form__unpaid-form-cover" id="unpaid-form">
                        {foreach item=con from=$unpaid_items}
                        <div class="b-block b-cabinet-form__unpaid-item">
                            <input type="checkbox" name="answer" class="b-inline b-concurs-racing-book__site-check b-cabinet-form__unpaid-item-check" value="product-{$con.id}">
                            <label class="b-inline b-concurs-racing-book__site-label b-cabinet-form__unpaid-item-label" for="product-{$con.id}"></label>
                            <span class="b-inline b-cabinet-form__unpaid-item-name">{$con.vc_name}</span>
                            <span class="b-inline b-cabinet-form__unpaid-item-num">{$con.price} {$con.vc_price_type}</span>
                        </div>
                        {/foreach}
                    </div>
                    <a href="" class="b-block b-cabinet-form__unpaid-form-button">Оплатить</a>
                </form>
            </div><!--
   --><div class="b-inline b-cabinet-form__kurs">
                <span class="b-block b-cabinet-form__kurs-header">Курс</span>
                <div class="b-inline b-cabinet-form__kurs-wrap"><span class="b-block b-cabinet-form__kurs-span"></span></div>
            </div>
        </div>
    </div>

    <figure class="b-cabinet-form-buy__wrap">
        <div class="b-cabinet-form-buy">
            <h2 class="b-block b-cabinet-form__header">Купить валюту сайта</h2>
            <a class="b-cabinet-form-buy__close"></a>
            <span class="b-block b-cabinet-form-buy__text">Способ оплаты</span>
            <div class="b-block b-cabinet-form-buy__payment-wrap">
                <a href="#" class="b-inline b-cabinet-form-buy__cover b-cabinet-form-buy__payment_1"><div class="b-block b-concurs__partner b-cabinet-form-buy__payment"></div></a>
                <a href="#" class="b-inline b-cabinet-form-buy__cover b-cabinet-form-buy__payment_2"><div class="b-block b-concurs__partner b-cabinet-form-buy__payment"></div></a>
                <a href="#" class="b-inline b-cabinet-form-buy__cover b-cabinet-form-buy__payment_3"><div class="b-block b-concurs__partner b-cabinet-form-buy__payment"></div></a>
                <a href="#" class="b-inline b-cabinet-form-buy__cover b-cabinet-form-buy__payment_4"><div class="b-block b-concurs__partner b-cabinet-form-buy__payment"></div></a>
                <a href="#" class="b-inline b-cabinet-form-buy__cover b-cabinet-form-buy__payment_5"><div class="b-block b-concurs__partner b-cabinet-form-buy__payment"></div></a>
                <a href="#" class="b-inline b-cabinet-form-buy__cover b-cabinet-form-buy__payment_6"><div class="b-block b-concurs__partner b-cabinet-form-buy__payment"></div></a>
                <a href="#" class="b-inline b-cabinet-form-buy__cover b-cabinet-form-buy__payment_7"><div class="b-block b-concurs__partner b-cabinet-form-buy__payment"></div></a>
                <a href="#" class="b-inline b-cabinet-form-buy__cover b-cabinet-form-buy__payment_8"><div class="b-block b-concurs__partner b-cabinet-form-buy__payment"></div></a>
            </div>
        </div>
    </figure>

    <figure class="b-cabinet-form-transfer__wrap">
        <div class="b-cabinet-form-transfer">
            <h2 class="b-block b-cabinet-form__header">Перевод другу</h2>
            <a class="b-cabinet-form-transfer__close"></a>
            <p class="b-block b-cabinet-form-transfer__text">Какой то&nbsp;текст о&nbsp;том что вы&nbsp;можете отправить своим друзьям деньги. Перечислить Авы своим друзьям и&nbsp;знакомым через кошелек на&nbsp;Аватории</p>
            <span class="b-inline b-cabinet-form-transfer__text b-cabinet-form-transfer__text_friends">Друг</span>
            <div class="g-out b-inline b-cabinet-form-transfer__friends">
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
            <div class="b-block b-cabinet-form-transfer__sum-wrap">
                <span class="b-inline b-cabinet-form-transfer__text b-cabinet-form-transfer__text_friends">Сумма</span>
                <input class="b-inline b-cabinet-form-transfer__sum">
                <span class="b-inline b-cabinet-form-transfer__text b-cabinet-form-transfer__sum_av">Ав</span>
            </div>
            <a href="#" class="b-inline b-cabinet__chat-contact-list-button b-cabinet-form-transfer__button"><span class="b-inline b-participants__button-text b-cabinet-form-transfer__button-text">Отменить</span></a>
            <a href="#" class="b-inline b-cabinet__chat-contact-list-button b-cabinet-form-transfer__button"><span class="b-inline b-participants__button-text b-cabinet-form-transfer__button-text">Перевести</span></a>
        </div>
    </figure>

    <figure class="b-cabinet-form-free__wrap">
        <div class="b-cabinet-form-free">
            <h2 class="b-block b-cabinet-form__header">Бесплатное пополнение</h2>
            <a class="b-cabinet-form-free__close"></a>
            <span class="b-block b-cabinet-form-buy__text">Приглашать друзей выгодно!</span>
            <p class="b-block b-cabinet-form-transfer__text b-cabinet-form-free__text-top">Какой то&nbsp;текст о&nbsp;том что вы&nbsp;можете отправить своим друзьям деньги. Перечислить Авы своим друзьям и&nbsp;знакомым через кошелек на&nbsp;Аватории</p>
            <span class="b-block b-cabinet-form-buy__text b-cabinet-form-free__text">Пригласить друзей через социальные сети</span>
            <a href="#" class="b-inline b-cabinet-form-free__link g-out"><img alt="Link 1" class="b-block b-title__border-img" height="30" src="{$i.base_url}/assets/header/purse/free/link-1.png" width="31" /></a>
            <a href="#" class="b-inline b-cabinet-form-free__link g-out"><img alt="Link 2" class="b-block b-title__border-img" height="30" src="{$i.base_url}/assets/header/purse/free/link-2.png" width="31" /></a>
            <a href="#" class="b-inline b-cabinet-form-free__link g-out"><img alt="Link 3" class="b-block b-title__border-img" height="30" src="{$i.base_url}/assets/header/purse/free/link-3.png" width="31" /></a>
            <a href="#" class="b-inline b-cabinet-form-free__link g-out"><img alt="Link 4" class="b-block b-title__border-img" height="30" src="{$i.base_url}/assets/header/purse/free/link-4.png" width="31" /></a>
            <a href="#" class="b-inline b-cabinet-form-free__link g-out"><img alt="Link 5" class="b-block b-title__border-img" height="30" src="{$i.base_url}/assets/header/purse/free/link-5.png" width="31" /></a>
            <a href="#" class="b-inline b-cabinet-form-free__link g-out"><img alt="Link 6" class="b-block b-title__border-img" height="30" src="{$i.base_url}/assets/header/purse/free/link-6.png" width="31" /></a>
            <span class="b-block b-cabinet-form-buy__text b-cabinet-form-free__text">или отправить приглашение серез email</span>
            <div class="b-block b-cabinet-form-transfer__sum-wrap">
                <span class="b-inline b-cabinet-form-transfer__text b-cabinet-form-transfer__text_friends">Email</span>
                <input class="b-inline b-cabinet-form-transfer__sum">
                <a href="#" class="b-inline b-cabinet__chat-contact-list-button b-cabinet-wall__delete-button"><span class="b-inline b-participants__button-text b-cabinet-wall__delete-button-text">Добавить</span></a>
            </div>
            <a href="#" class="b-center b-cabinet__chat-contact-list-button b-cabinet-form-free__button"><span class="b-inline b-participants__button-text b-cabinet-form-transfer__button-text">Пригласить</span></a>
        </div>
    </figure>