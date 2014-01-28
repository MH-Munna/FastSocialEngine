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

</div>
</header>
