{*head*}
{include file='main/head.tpl'}
{*top_block*}
<div class="wrapper">
<div class="wrapper_in">
{include file='main/top_block.tpl'}

<script>
    window.viewProfileID = {$opened_profile};
    window.myProfileID = {$user_uid};
    window.lastEventId = {$user.fk_first_unread_event};
</script>

<script>
    window.onload=function(){
        $('#beg_stroka').show(1500);
        {if $user.i_profile_info eq '0'}
            get_my_config();
        {/if}
    };
</script>


<div class="mark">
    <div class="top_panel">
        <div class="alert">
            {*beg_stroka*}
            {include file='main/beg_stroka.tpl'}
        </div>
        <div class="tiket">
            {*stikers*}
            {include file='main/stikers.tpl'}
        </div>
        <div class="search">
            <form>
                <input id="query_search_text" type="text" placeholder="Поиск" />
                <input type="image" src="/images/profile/submit.png" onclick="search_dialog(); return false;"/>
            </form>
        </div>
    </div>
    <div class="clr"></div>
</div>
<div class="content">
<div class="main">
<div class="left">
    <a href="#" onclick="return click_to_load_main_avatar()" class="avatar">
        <img id="opened_profile_main_avatar" src="{$opened_profile_info.avatar_url233x233}" />
    </a>

    <div style='display: none;'>
        <script>
            function start_upload_avatar(){
                $('#opened_profile_main_avatar').fadeTo('slow', 0.5);
                document.uploadavatar.submit();
            }
        </script>

        <div class="upload-avatar">
            <form target="hiddenframe-avatar" enctype="multipart/form-data" action="/uploads/upload_avatar.php" method="post" name="uploadavatar">
                <input type="file" id="upload_avatar" name="upload_avatar" onchange="start_upload_avatar();" />
                <iframe name="hiddenframe-avatar" class="hiddenframe-avatar"></iframe>
            </form>
        </div>

        <div class="upload-avatar" id="upload-avatar">
        </div>
        <div class="console-avatar" id="console-avatar">
        </div>
    </div>

    <ul class="star">
        <li class="active"><a href=""></a></li>
        <li class="active"><a href=""></a></li>
        <li class="active"><a href=""></a></li>
        <li><a href=""></a></li>
        <li><a href=""></a></li>
        <li><a href=""></a></li>
    </ul>
    <p class="tr"><i class="b-ico b-ico_type_trof"></i>25<span>VIP</span></p>
    <div class="clr"></div>
    <p class="fio" id="opened_profile_info">{$opened_profile_info.ch_fname} {$opened_profile_info.ch_lname}</p>
    <span class="date">{$opened_profile_info.d_bdate}</span>
    <div class="line"></div>
    <ul class="button">
        <li onclick="$('#dop_info').text('{$opened_profile_info.vc_city}');" class="active">страна / город</li>
        <li onclick="$('#dop_info').text('{$opened_profile_info.vc_status}');">статус</li>
        <li onclick="$('#dop_info').text('{$opened_profile_info.ch_hobbi}');">Хобби</li>
        <li onclick="$('#dop_info').text('{$opened_profile_info.ch_mechta}');">Мечта</li>
    </ul>
    <div class="clr"></div>
    <p class="date" id="dop_info">{$opened_profile_info.vc_city}</p>
    <p class="date" id="dop_info">{$friendship}</p>

    <div id="button_add_friends">
        {include file='friends/button_add_friend.tpl'}
    </div>
    <div id="button_start_chat">
        {include file='dialogs/button_start_chat.tpl'}
    </div>
    {include file='friends/friends_list_old.tpl'}

    <div class="baner">
        <a href=""><img src="/images/profile/baner1.jpg" /></a>
    </div>
    <div class="baner">
        <a href=""><img src="/images/profile/baner2.jpg" /></a>
    </div>
    <div class="baner">
        <a href=""><img src="/images/profile/baner3.jpg" /></a>
    </div>
</div>
<div class="center">
<h1 class="today">Выиграй сегодня</h1>
<div id="slides">
    <img src="/images/profile/slide.png"/>
    <img src="/images/profile/canon.png" />
</div>
<div class="drop" id="draggable">
    <p class="draggable"><i class="b-ico b-ico_size_35 b-ico_type_draggable"></i></p>
    <p class="link"><i class="b-ico b-ico_size_35 b-ico_type_link"></i></p>
    <div class="clr"></div>
    <div class="images">
        <img src="{t}multivizor3{/t}" />
    </div>
    <div class="text">
        <h1>{t}multivizor{/t}</h1>
        <p>{t}multivizor2{/t} </p>
    </div>
    <div class="clr"></div>
    <a href="" class="d_prev"><i class="b-ico b-ico_type_left"></i></a>
    <a href="" class="d_next"><i class="b-ico b-ico_type_right"></i></a>
    <ul>
        <li class="active info"><a href=""><i class="b-ico b-ico_type_info"></i><span>INFO</span></a></li>
        <li class="tv"><a href=""><i class="b-ico b-ico_type_tv"></i><span>TV</span></a></li>
        <li class="radio"><a href=""><i class="b-ico b-ico_type_radio"></i><span>RADIO</span></a></li>
        <li class="smile"><a href=""><i class="b-ico b-ico_type_smile"></i><span>ЛИЦА</span></a></li>
    </ul>
</div>
<div class="clr"></div>
<div id="tabs">
<ul>
    <li><a href="#tabs-1"><i class="b-ico b-ico_size_35 b-ico_type_wall"></i><span>Стена</span></a></li>
    <li><a href="#tabs-2"><i class="b-ico b-ico_size_35 b-ico_type_group"></i><span>Группы</span></a></li>
    <li id="user_chats"><a href="#tabs-3"><div id="sizeof_messages"></div><i class="b-ico b-ico_size_35 b-ico_type_chat"></i><span>Чат</span></a></li>
    <li><a href="#tabs-4" {*onclick="select_tab('photo'); return false;"*}><i class="b-ico b-ico_size_35 b-ico_type_photo"></i><span>Фото</span></a></li>
    <li><a href="#tabs-5"><i class="b-ico b-ico_size_35 b-ico_type_music"></i><span>Музыка</span></a></li>
    <li><a href="#tabs-6" {*onclick="select_tab('videos'); return false;"*}><i class="b-ico b-ico_size_35 b-ico_type_video"></i><span>Видео</span></a></li>
    <li><a href="#tabs-7" {*onclick="select_tab('apps'); return false;"*}><i class="b-ico b-ico_size_35 b-ico_type_game"></i><span>Игры</span></a></li>
    {*<li><a href="#tabs-8"><i class="b-ico b-ico_size_35 b-ico_type_presents"></i><span>Подарки</span></a></li>*}
    {*<li><a href="#tabs-9"><i class="b-ico b-ico_size_35 b-ico_type_avitter"></i><span>Авиттер</span></a></li>*}
</ul>
<div class="clr"></div>
<div id="tabs-1">
    <h1><span>Стена</span></h1>
    {include file="comments/com.tpl" id=$opened_profile type='wall'}
</div>
<div id="tabs-2">
    <h1><span>Группы</span></h1>
    <div class="group">
        <div class="filtr">
            <div class="active my">
                Мои группы<span>2/10</span>
            </div>
            <div class="all">
                <p>Все группы <span>210</span></p>
            </div>
            <div class="new"><a href=""><img src="/images/profile/new.png" /></a></div>
        </div>
        <div class="clr"></div>
        <div class="elements">
            <div class="gr">
                <img src="/images/profile/gro.png" />
                <span>+181</span>
                <p>
                    <a href="">Длинное название группы</a><br />
                    <span>213 участников</span>
                </p>
            </div>
            <div class="gr">
                <img src="/images/profile/gro.png" />
                <span>+181</span>
                <p>
                    <a href="">Длинное название группы</a><br />
                    <span>213 участников</span>
                </p>
            </div>
            <div class="gr">
                <img src="/images/profile/gro.png" />
                <span>+181</span>
                <p>
                    <a href="">Длинное название группы</a><br />
                    <span>213 участников</span>
                </p>
            </div>
            <div class="gr">
                <img src="/images/profile/gro.png" />
                <span>+181</span>
                <p>
                    <a href="">Длинное название группы</a><br />
                    <span>213 участников</span>
                </p>
            </div>
            <div class="gr">
                <img src="/images/profile/gro.png" />
                <span>+181</span>
                <p>
                    <a href="">Длинное название группы</a><br />
                    <span>213 участников</span>
                </p>
            </div>
            <div class="gr">
                <img src="/images/profile/gro.png" />
                <span>+181</span>
                <p>
                    <a href="">Длинное название группы</a><br />
                    <span>213 участников</span>
                </p>
            </div>
        </div>
        <div class="clr"></div>
    </div>
    </div>
    <div id="tabs-3">
        <h1><span>Чат</span></h1>
            <div class="cont">
                {include file='dialogs/dialogs_main.tpl'}
            </div>
    </div>

    <div id="tabs-4">
        <h1><span>Фото</span></h1>
        <div id="tabContent_photo">
            {include file='photo/photo_main_old.tpl'}
        </div>
</div>
<div id="tabs-5">
    <h1><span>Музыка</span></h1>
    <div>Музыка</div>
</div>
<div id="tabs-6">
    <h1><span>Видео</span></h1>
    <div class="video" id="tabContent_videos">
        {include file='videos/main.tpl'}
    </div>

</div>
<div id="tabs-7">
    <h1><span>Игры</span></h1>
    <div id="tabContent_apps" class="video game">
        {include file='apps/apps_main_old.tpl'}
    </div>
</div>
{*<div id="tabs-8">*}
    {*<h1><span>Подарки</span></h1>*}
    {*<div>Подарки</div>*}
{*</div>*}
{*<div id="tabs-9">*}
    {*<h1><span>Авиттер</span></h1>*}
    {*<div>Авиттер</div>*}
{*</div>*}
</div>
</div>

<div class="right">
    <ul class="menu">
        <li><a href=""><i class="b-ico b-ico_size_35 b-ico_type_playstation"></i>Конкурсы</a></li>
        <li><a href="{$i.base_url}/service/shopping"><i class="b-ico b-ico_size_35 b-ico_type_buy"></i>Веселый шоппинг</a></li>
        <li><a href=""><i class="b-ico b-ico_size_35 b-ico_type_gallery"></i>Галерея сети</a></li>
        <li><a href=""><i class="b-ico b-ico_size_35 b-ico_type_globe"></i>Биржа туров</a></li>
        <li><a href=""><i class="b-ico b-ico_size_35 b-ico_type_shop"></i>Чек-маркет</a></li>
        <li><a href=""><i class="b-ico b-ico_size_35 b-ico_type_cinema"></i>Кино-Приз</a></li>
    </ul>
</div>
<div class="clr"></div>
<div class="gamer">
    <img src="/images/profile/gamer.jpg"/>
</div>
<div class="order_table">
    <div class="order_item-Pizza">
        <div class="order_item-Header_pizza">
        </div>
        <div class="order_item-Vertical">
            <div class="order_item-Empty_box filled">
                <a href="http://www.pizzahut.com/"target="_blank">
                    <img src="{$i.base_url}/images/profile/orders/pizza_hot.png" alt="pizza hot"/>
                </a>
            </div>
            <div class="order_item-Empty_box">
                <a href="#"></a>
            </div>
            <div class="order_item-Empty_box">
                <a href="#"></a>
            </div>
        </div>
        <div class="order_item-Gorison">
            <div class="order_item-Empty_box">
                <a href="#"></a>
            </div>
            <div class="order_item-Empty_box">
                <a href="#"></a>
            </div>
            <div class="order_item-Empty_box">
                <a href="#"></a>
            </div>
        </div>
    </div>
    <div class="order_item-Delish">
        <div class="order_item-Header_delish">
        </div>
        <div class="order_item-Vertical">
            <div class="order_item-Empty_box filled">
                <a href="http://www.pansmetan.ru/"target="_blank">
                    <img src="{$i.base_url}/images/profile/orders/pan_smetan.png" alt="pan_smetan" width="77" height="77"/>
                </a>
            </div>
            <div class="order_item-Empty_box">
                <a href="#"></a>
            </div>
            <div class="order_item-Empty_box">
                <a href="#"></a>
            </div>
        </div>
        <div class="order_item-Gorison">
            <div class="order_item-Empty_box">

                <a href="#">

                </a>
            </div>
            <div class="order_item-Empty_box filled">
                <a href="http://www.pansmetan.ru/"target="_blank">
                    <img src="{$i.base_url}/images/profile/orders/pan_smetan.png" alt="pan_smetan" width="77" height="77"/>
                </a>
            </div>
            <div class="order_item-Empty_box">
                <a href="#"></a>
            </div>
        </div>
    </div>
    <div class="order_item-Sushi">
        <div class="order_item-Header_sushi">
        </div>
        <div class="order_item-Vertical">
            <div class="order_item-Empty_box filled">
                <a href="#">
                    <img src="{$i.base_url}/images/profile/orders/dostavka_sushi.png" alt="доставка sushi" width="77" height="77"/>
                </a>
            </div>
            <div class="order_item-Empty_box filled">
                <img src="{$i.base_url}/images/profile/orders/sushi.png" alt="доставка sushi" width="77" height="77"/>
            </div>
            <div class="order_item-Empty_box filled">
                <a href="#">
                    <img src="{$i.base_url}/images/profile/orders/tsunami.png" alt="доставка sushi" width="77" height="77"/>
                </a>
            </div>
        </div>
        <div class="order_item-Gorison">
            <div class="order_item-Empty_box filled">
                <a href="#">
                    <img src="{$i.base_url}/images/profile/orders/pan_smetan.png" alt="pan_smetan" width="77" height="77"/>
                </a>
            </div>
            <div class="order_item-Empty_box">
                <a href="#"></a>
            </div>
            <div class="order_item-Empty_box">
                <a href="#"></a>
            </div>
        </div>
    </div>
    <p>Стол заказов вкусностей с бонусами.</p>
</div>
</div>
</div>
</div>
</div>

<!-- <script type="text/javascript" src="build/modulargrid.js"></script> -->
<div class="partners">
    <h2 class="partner-title">Партнеры</h2>
    <ul class="partner-menu">
        <li class="partner-menu-item"><a href="#"><img src="/images/profile/partner1.jpg" alt="" height="100" width="200"/></a></li>
        <li class="partner-menu-item"><a href="#"><img src="/images/profile/partner2.jpg" alt="" height="100" width="200"/></a></li>
        <li class="partner-menu-item"><a href="#"><img src="/images/profile/partner3.jpg" alt="" height="100" width="200"/></a></li>
        <li class="partner-menu-item"><a href="#"><img src="/images/profile/partner4.jpg" alt="" height="100" width="200"/></a></li>
        <li class="partner-menu-item"><a href="#"><img src="/images/profile/partner5.jpg" alt="" height="100" width="200"/></a></li>
        <li class="partner-menu-item"><a href="#"><img src="/images/profile/partner6.jpg" alt="" height="100" width="200"/></a></li>
    </ul>
</div>
<div class="footer">
    <div class="b-copyright">
        &copy; Аватория<br/>
        Все права защищены.
    </div>
    <div class="footer-navigation">
        <ul class="footer-menu">
            <li class="footer-menu-item"><a href="">Пожаловаться</a></li>
            <li class="footer-menu-item"><a href="">Ответить на вопросы</a></li>
            <li class="footer-menu-item"><a href="">Реклама</a></li>
            <li class="footer-menu-item"><a href="">Предложения</a></li>
            <li class="footer-menu-item"><a href="">Советы</a></li>
            <li class="footer-menu-item"><a href="">Контакты</a></li>
        </ul>
        <ul class="footer-buttons">
            <li class="footer-button"><a href=""><i class="b-ico b-ico_footer-cat"></i><span
                            class="footer-button__text">Собери свои призы</span></a></li>
            <li class="footer-button"><a href=""><i class="b-ico b-ico_footer-dog"></i><span
                            class="footer-button__text">Собери призы своих друзей</span></a></li>
        </ul>
    </div>
</div>

</body>
</html>