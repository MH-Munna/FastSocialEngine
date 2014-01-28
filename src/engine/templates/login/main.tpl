{include file='login/header.tpl'}
<body>





<div id="container">
    <div id="header">Welcome to FastSE</div>
    <div id="sidebar">
        <form action="/login/auth.php" method="POST">
            <p><input name="login" id="enter_login" type="text" placeholder="{t}login{/t}" class="b-input_text"></p>
            <p><input name="pass" id="enter_pass" type="password" placeholder="{t}password{/t}" class="b-input_text"></p>
            <p><input type="button" onclick="enter_avatoria($('#enter_login').val(), $('#enter_pass').val());" value="{t}voiti{/t}" class="b-big_btn m-strongblue"></p>
        </form>


        <a href="{$vk_auth_link}" title="vk"><i class="b-ico m-vk"></i></a>
        <a href="{$ok_auth_link}" title="odnoklassniki"><i class="b-ico m-ok"></i></a>
        <a href="{$mr_auth_link}" onclick="return false" title="mail.ru"><i class="b-ico m-mail"></i></a>
        <a href="{$gg_auth_link}" title="Google+"><i class="b-ico m-gp"></i></a>
        <a href="#" onclick="return false" title="Twitter"><i class="b-ico m-tw"></i></a>
        <a href="{$fb_auth_link}" title="Facebook"><i class="b-ico m-fb"></i></a>
    </div>
    <div id="content">
        <h2>Fast SE</h2>
        <p>Info about this engine</p>
        <hr />

        <form action="/login/reg.php" method="post">
            <p><input name="login" type="text" placeholder="{t}login{/t}" class="b-input_text"></p>
            <p><input name="password" type="password" placeholder="{t}password{/t}" class="b-input_text"></p>
            <p><input type="submit" value="{t}regestration{/t}" class="b-big_btn m-blue"></p>
        </form>

    </div>
    <div id="footer"></div>
</div>

{include file='login/footer.tpl'}