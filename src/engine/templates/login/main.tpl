{include file='login/header.tpl'}


<body>

<ul class="navigation">
    <li data-slide="1">Slide 1</li>
    <li data-slide="2">Slide 2</li>
    <li data-slide="3">Slide 3</li>
    <li data-slide="4">Slide 4</li>
</ul>




<!--<img class="envatologo" src="../images/login/envatologo.png">-->



<div class="slide" id="slide1" data-slide="1" data-stellar-background-ratio="0.5">
    <div class="b-wrapper">
        <div class="b-wrapper_in">
            {*<form action="">*}
                <div class="b-column m1-3">
                    <div class="b-header">
                        <div class="b-logo">
                          <a href="#"  title="Avatoria.ru"><img src="../images/login/logo.png" alt="Avatoria.ru"></a>
                        </div>
                        <div class="b-enter">
                            <a href="#" title="Вход" class="enter-btn" style="background-image:url({t}url_to_enter_btn{/t})"></a>
                            <div class="b-float-reg" style="display:none;">
                                <div class="b-reg_up"></div>
                                <div class="b-reg_content">
                                    <div class="b-reg_form">
                                      <form action="/login/auth.php" method="POST">
                                        <ul class="b-reg_items">
                                            <li><input name="login" id="enter_login" type="text" placeholder="{t}login{/t}" class="b-input_text"></li>
                                            <li><input name="pass" id="enter_pass" type="password" placeholder="{t}password{/t}" class="b-input_text"></li>
                                            <li><input type="button" onclick="enter_avatoria($('#enter_login').val(), $('#enter_pass').val());" 
                                                       value="{t}voiti{/t}" class="b-big_btn m-strongblue"></li>
                                        </ul>
                                      </form>
                                    </div>
                                    <div class="b-reg_social">
                                        <p class="b-small-text"><a href="#">{t}vostanovit_parol{/t}</a></p>
                                        <hr>
                                        <p class="b-small-text">{t}bistraya_registraciya_cherez_socseti{/t}</p>
                                        <ul class="b-social-items">
                                            <li><a href="{$vk_auth_link}" title="vk"><i class="b-ico m-vk"></i></a></li>
                                            <li><a href="{$ok_auth_link}" title="odnoklassniki"><i class="b-ico m-ok"></i></a></li>
                                            <li><a href="{$mr_auth_link}" onclick="return false" title="mail.ru"><i class="b-ico m-mail"></i></a></li>
                                            <li><a href="{$gg_auth_link}" title="Google+"><i class="b-ico m-gp"></i></a></li>
                                            <li><a href="#" onclick="return false" title="Twitter"><i class="b-ico m-tw"></i></a></li>
                                            <li><a href="{$fb_auth_link}" title="Facebook"><i class="b-ico m-fb"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="b-reg_down"></div>
                            </div>
                        </div>
                    </div>
                    <div class="b-intro">
                        <h1>{t}main_zag{/t}</h1>
                        <p>{t}main_text{/t}</p>
                    </div>

                    <div class="b-main_login">
                        <div class="b-reg_up"></div>
                        <div class="b-reg_content">
                            <div class="b-reg_header">
                                <div class="b-grad"></div>
                                <h1>25 билетов</h1>
                                <p>{t}bileti_superpriz{/t}</p>
                            </div>
                            <div class="b-reg_form">
                                <form action="/login/reg.php" method="post">
                                <ul class="b-reg_items">
                                    <li><input name="login" type="text" placeholder="{t}login{/t}" class="b-input_text"></li>
                                    <li><input name="password" type="password" placeholder="{t}password{/t}" class="b-input_text"></li>
                                    <li><input type="submit" value="{t}regestration{/t}" class="b-big_btn m-blue"></li>
                                </ul>
                                </form>
                            </div>
                            <div class="b-reg_social">
                                <hr>
                                <p class="b-small-text">{t}bistraya_registraciya_cherez_socseti{/t}</p>
                                <ul class="b-social-items">
                                    <li><a href="{$vk_auth_link}" title="vk"><i class="b-ico m-vk"></i></a></li>
                                    <li><a href="{$ok_auth_link}" title="odnoklassniki"><i class="b-ico m-ok"></i></a></li>
                                    <li><a href="{$mr_auth_link}" onclick="return false" title="mail.ru"><i class="b-ico m-mail"></i></a></li>
                                    <li><a href="{$gg_auth_link}" title="Google+"><i class="b-ico m-gp"></i></a></li>
                                    <li><a href="#" onclick="return false" title="Twitter"><i class="b-ico m-tw"></i></a></li>
                                    <li><a href="{$fb_auth_link}" title="Facebook"><i class="b-ico m-fb"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="b-reg_down"></div>
                    </div>
                </div>
                <div class="b-column m2-3">
                    <div class="b-lang-select">
                        <ul class="b-lang_items">
                            <li class="lang-active"><a href="/login/lang.php?lang=1" title="RU" class="m-ru"></a></li>
                            <li><a href="/login/lang.php?lang=2" title="UK" class="m-uk"></a></li>
                            <li><a href="/login/lang.php?lang=3" title="DE" class="m-de"></a></li>
                            <li><a href="/login/lang.php?lang=4" title="FR" class="m-fr"></a></li>
                            <li><a href="/login/lang.php?lang=5" title="IT" class="m-it"></a></li>
                            <li><a href="/login/lang.php?lang=6" title="EN" class="m-en"></a></li>
                        </ul>
                    </div>
                    <div class="b-scroller">
                        <ul id="ticker01">
                            <li><span>10/10/2007</span><a href="#/ogt/content/news/News183.complete">{t}begushaya_stroka{/t}</a></li>

                        </ul>
                    </div>
                </div>
            {*</form>*}
        </div>
        <div class="b-wrapper m-subline">
            <div class="b-wrapper_in">
                <ul class="b-subnavi">
                    <li><a class="to_slide m2" data-slide="2"><i class="b-ico"></i>{t}konkursi{/t}</a></li>
                    <li><a class="to_slide m3" data-slide="3"><i class="b-ico"></i>{t}podarki{/t}</a></li>
                    <li><a class="to_slide m4" data-slide="4"><i class="b-ico"></i>{t}ispitai_udachu{/t}</a></li>
                </ul>
            </div>
        </div>
    </div>



</div><!--End Slide 1-->



<div class="slide" id="slide2" data-slide="2" data-stellar-background-ratio="0.5">
    <div class="b-wrapper">

        <div class="b-wrapper_in m-ko">
            <h2>{t}ejednevnie_konkursi{/t}</h2>

            <div class="b-slider" id="slider1">

                <div class="b-slider_window m-left">
                    <div class="b-image_container">
                        <ul>
                            <li id="sl1"><a href=""><img src="../images/login/slide2/cat.png" alt="Жирный кот"></a></li>

                            <li id="sl2"><a href=""><img src="../images/login/slide2/dog.png" alt="Жирный пес"></a></li>

                            <li id="sl3"><a href=""><img src="../images/login/slide2/photo.png" alt="Битва фотографий"></a></li>

                            <li id="sl4"><a href=""><img src="../images/login/slide2/baron.png" alt="Игровой барон"></a></li>

                            <li id="sl5"><a href=""><img src="../images/login/slide2/site.png" alt="Сайт рейсинг"></a></li>

                            <li id="sl6"><a href=""><img src="../images/login/slide2/friends.png" alt="Час друзей"></a></li>

                            <li id="sl7"><a href="#"><img src="../images/login/slide2/sense.png" alt="Битва интуиции"></a></li>
                        </ul>
                    </div>
                    <div class="b-section">
                        <div class="b-big_btn m-blue to_slide" data-slide="4">{t}hochu_uchvstvovat{/t}</div>
                    </div>
                </div>
                <div class="b-slider_navi m-right">
                    <ul class="b-slider_navitems m-dark">
			<li><a href="#sl1" class="m-ko1" onclick="return false"><i class="b-ico"></i>{t}jirnii_kot{/t}</a></li>
			<li><a href="#sl2" class="m-ko2" onclick="return false"><i class="b-ico"></i>{t}jirnii_pes{/t}</a></li>
			<li><a href="#sl3" class="m-ko3" onclick="return false"><i class="b-ico"></i>{t}bitva_fotografii{/t}</a></li>
			<li><a href="#sl4" class="m-ko4" onclick="return false"><i class="b-ico"></i>{t}igrovoi_baron{/t}</a></li>
			<li><a href="#sl5" class="m-ko5" onclick="return false"><i class="b-ico"></i>{t}site_rasing{/t}</a></li>
			<li><a href="#sl6" class="m-ko6" onclick="return false"><i class="b-ico"></i>{t}chas_druzei{/t}</a></li>
			<li><a href="#sl7" class="m-ko7" onclick="return false"><i class="b-ico"></i>{t}bitva_intuicii{/t}</a></li>
                    </ul>
                </div>

            </div>

        </div>
    </div>
</div><!--End Slide 2-->





<div class="slide" id="slide3" data-slide="3" data-stellar-background-ratio="0.5">
    <div class="wrapper">
        <div class="b-wrapper_in m-prise">
            <div class="b-arrow m-viol">
                <span>{t}chto_mojno_vigrat{/t}</span>
            </div>
            <h2>{t}prizi_i_podarki_v_seti{/t}</h2>
            <div class="b-slider" id="slider2">
                <div class="b-slider_window m-right">
                    <div class="b-image_container">
                        <ul>
                            <li id="sl10"><a href=""><img src="../images/login/slide3/canon.png" alt=""></a></li>

                            <li id="sl11"><a href=""><img src="../images/login/slide3/iphone.png" alt=""></a></li>

                            <li id="sl12"><a href=""><img src="../images/login/slide3/imac.png" alt=""></a></li>

                            <li id="sl13"><a href=""><img src="../images/login/slide3/tiket.png" alt=""></a></li>

                            <li id="sl14"><a href=""><img src="../images/login/slide3/ipad.png" alt=""></a></li>

                            <li id="sl15"><a href=""><img src="../images/login/slide3/cam.png" alt=""></a></li>

                            <li id="sl16"><a href="#"><img src="../images/login/slide3/tv.png" alt="TV"></a></li>
                        </ul>
                    </div>
                    <div class="b-section">
                        <div class="b-big_btn m-blue to_slide" data-slide="4">{t}hochu_poluchit{/t}</div>
                    </div>
                </div>
                <div class="b-slider_navi m-left">
                    <ul class="b-slider_navitems m-light">
			<li><a href="#sl10" onclick="return false">Canon mark 4</a></li>
			<li><a href="#sl11" onclick="return false">iPhone 5S</a></li>
			<li><a href="#sl12" onclick="return false">Macbook Pro 15 Retina</a></li>
			<li><a href="#sl13" onclick="return false">{t}putevki{/t}</a></li>
			<li><a href="#sl14" onclick="return false">iPad 3</a></li>
			<li><a href="#sl15" onclick="return false">GoPRO 3</a></li>
			<li><a href="#sl16" onclick="return false">Телевизор Philips IPTV</a></li>
                    </ul>
                </div>
            </div>

        </div>

    </div>

</div><!--End Slide 3-->






<div class="slide" id="slide4" data-slide="4" data-stellar-background-ratio="0">

    <div class="wrapper">
        <div class="b-wrapper_in m-light">
            <h2>{t}bonusnaya_registraciya{/t}</h2>
            <h3>{t}text_bonus{/t}</h3>
            <p class="b-second-info">{t}text_meshki{/t}</p>
            <div class="b-form_selector">
                <ul class="b-budgets">
                    <li class="b-budget b-num1"><i class="b-halo"></i><a href="#01"><em></em><i></i></a></li>
                    <li class="b-budget b-num2"><i class="b-halo"></i><a href="#02"><em></em><i></i></a></li>
                    <li class="b-budget b-num3"><i class="b-halo"></i><a href="#03"><em></em><i></i></a></li>
                </ul>
            </div>
            <div class="b-section" id="01" style="display:none">
                <div class="b-budget-contain">
                    <ul class="b-budgets">
                        <li class="b-budget b-num1"><i class="b-halo"></i><a href="#01"><em></em><i></i></a></li>
                    </ul>
                </div>
                <div class="b-reg_form">
                    <ul class="b-reg_items">
                        <li><input type="text" placeholder="{t}login{/t}" class="b-input_text"></li>
                        <li><input type="password" placeholder="{t}password{/t}" class="b-input_text"></li>
                        <li><input type="submit" value="{t}regestration{/t}" class="b-big_btn m-blue"></li>
                    </ul>
                </div>
                <div class="b-reg_social">
                    <p class="b-small-text">{t}bistraya_registraciya_cherez_socseti{/t}</p>
                    <ul class="b-social-items">
                        <li><a href="#" title="vk"><i class="b-ico m-vk"></i></a></li>
                        <li><a href="#" title="odnoklassniki"><i class="b-ico m-ok"></i></a></li>
                        <li><a href="#" title="mail.ru"><i class="b-ico m-mail"></i></a></li>
                        <li><a href="#" title="Google+"><i class="b-ico m-gp"></i></a></li>
                        <li><a href="#" title="Twitter"><i class="b-ico m-tw"></i></a></li>
                        <li><a href="#" title="Facebook"><i class="b-ico m-fb"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="b-section" id="02" style="display:none">
                <div class="b-budget-contain">
                    <ul class="b-budgets">
                        <li class="b-budget b-num2"><i class="b-halo"></i><a href="#01"><em></em><i></i></a></li>
                    </ul>
                </div>
                <div class="b-reg_form">
                    <ul class="b-reg_items">
                        <li><input type="text" placeholder="{t}login{/t}" class="b-input_text"></li>
                        <li><input type="password" placeholder="{t}password{/t}" class="b-input_text"></li>
                        <li><input type="submit" value="{t}regestration{/t}" class="b-big_btn m-blue"></li>
                    </ul>
                </div>
                <div class="b-reg_social">
                    <p class="b-small-text">{t}bistraya_registraciya_cherez_socseti{/t}</p>
                    <ul class="b-social-items">
                        <li><a href="#" title="vk"><i class="b-ico m-vk"></i></a></li>
                        <li><a href="#" title="odnoklassniki"><i class="b-ico m-ok"></i></a></li>
                        <li><a href="#" title="mail.ru"><i class="b-ico m-mail"></i></a></li>
                        <li><a href="#" title="Google+"><i class="b-ico m-gp"></i></a></li>
                        <li><a href="#" title="Twitter"><i class="b-ico m-tw"></i></a></li>
                        <li><a href="#" title="Facebook"><i class="b-ico m-fb"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="b-section" id="03" style="display:none">
                <div class="b-budget-contain">
                    <ul class="b-budgets">
                        <li class="b-budget b-num3"><i class="b-halo"></i><a href="#01"><em></em><i></i></a></li>
                    </ul>
                </div>
                <div class="b-reg_form">
                    <ul class="b-reg_items">
                        <li><input type="text" placeholder="{t}login{/t}" class="b-input_text"></li>
                        <li><input type="password" placeholder="{t}password{/t}" class="b-input_text"></li>
                        <li><input type="submit" value="{t}regestration{/t}" class="b-big_btn m-blue"></li>
                    </ul>
                </div>
                <div class="b-reg_social">
                    <p class="b-small-text">{t}bistraya_registraciya_cherez_socseti{/t}</p>
                    <ul class="b-social-items">
                        <li><a href="#" title="vk"><i class="b-ico m-vk"></i></a></li>
                        <li><a href="#" title="odnoklassniki"><i class="b-ico m-ok"></i></a></li>
                        <li><a href="#" title="mail.ru"><i class="b-ico m-mail"></i></a></li>
                        <li><a href="#" title="Google+"><i class="b-ico m-gp"></i></a></li>
                        <li><a href="#" title="Twitter"><i class="b-ico m-tw"></i></a></li>
                        <li><a href="#" title="Facebook"><i class="b-ico m-fb"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>


</div><!--End Slide 4-->
</body>

{include file='login/footer.tpl'}