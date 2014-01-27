<!DOCTYPE html>
<html>
<head>
    <title>AvatoriaRu</title>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
    <link href="assets/application.css?body=1" media="screen" rel="stylesheet" />
    <link href="assets/home.css?body=1" media="screen" rel="stylesheet" />

    <script src="assets/jquery.js?body=1"></script>
    <script src="assets/jquery_ujs.js?body=1"></script>
    <script src="assets/home.js?body=1"></script>
    <script src="assets/application.js?body=1"></script>

    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic&subset=cyrillic' rel='stylesheet' type='text/css'>
    <!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>


<div class="l-home_wrap">

    {include file='service/include/top_block.tpl' header_class="b-block l-header"}

    <div class="g-out l-base b-top">
        <div class="b-inline b-top__header-wrap">
            <span class="b-top__header-text">Сделка по правилам покупателя!</span>
        </div>
        <div class="b-inline b-top__text-moon">
            <h2 class="b-top__text-header">Хотите новыx&nbsp;приключений?</h2>
            <p class="b-top__text">Тогда давайте к нам в нескончаемый поток конкурсов, подарков, дружелюбного общения и приятных эмоций</p>
        </div>
    </div>
    <div class="g-out l-shops">
        <section class="l-base b-shops">
            <a href="{$i.base_url}/service/shopping/max.php" class="b-shop__link b-shop__max-percent">
                <div class="b-shop b-shop__max-percent_fon">
                    <span class="b-shop__text">Максимальный&nbsp;процент скидки</span>
                </div>
            </a><a href="{$i.base_url}/service/shopping/click.php" class="b-shop__link b-shop__click">
                <div class="b-shop b-shop__click_fon">
                    <span class="b-shop__text">Понижение цены<br>кликом</span>
                </div>
            </a><a href="{$i.base_url}/service/shopping/torg.php" class="b-shop__link b-shop__bargain">
                <div class="b-shop b-shop__bargain_fon">
                    <span class="b-shop__text">Торг<br>с продавцом</span>
                </div>
            </a><a href="{$i.base_url}/service/shopping/collective.php" class="b-shop__link b-shop__collective">
                <div class="b-shop b-shop__collective_fon">
                    <span class="b-shop__text">Сервис коллективных&nbsp;покупок</span>
                </div></a>
        </section>
    </div>
    <div class="b-block g-out b-earth"></div>
</div>
<footer class="b-block b-footer">
    <div class="l-base">
        <span class="b-inline b-footer__copyright">© Аватория Все&nbsp;права защищены</span>
        <section class="b-footer__bottom">
            <a href="#" class="b-inline b-footer__bottom-menu-link">Пожаловаться
            </a><a href="#" class="b-inline b-footer__bottom-menu-link">Ответить на вопросы
            </a><a href="#" class="b-inline b-footer__bottom-menu-link">Реклама
            </a><a href="#" class="b-inline b-footer__bottom-menu-link">Предложения
            </a><a href="#" class="b-inline b-footer__bottom-menu-link">Советы
            </a><a href="#" class="b-inline b-footer__bottom-menu-link">Контакты
            </a>
            <div class="b-footer__bottom-cat-dog">
                <a href="#" class="b-inline b-footer__bottom-link b-footer__bottom-link_cat">
                    <div class="b-footer__wrap b-footer__cat">
                        <span class="b-inline b-footer__bottom-text">Собери свои призы</span>
                    </div>
                </a><a href="#" class="b-inline b-footer__bottom-link b-footer__bottom-link_dog">
                    <div class="b-footer__wrap b-footer__dog">
                        <span class="b-inline b-footer__bottom-text">Собери призы своих друзей</span>
                    </div>
                </a>
            </div>
        </section>
    </div>
</footer>


</body>
</html>