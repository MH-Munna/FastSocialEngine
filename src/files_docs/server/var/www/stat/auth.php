<?php
require_once('config.php');

$ip=$_SERVER["REMOTE_ADDR"];

function set_cookie($name,$pass)
{
    global $ip;
    $tmppos=strrpos($_SERVER["PHP_SELF"],"/") +1;
    $path=substr($_SERVER["PHP_SELF"],0,$tmppos);
    //Шифруем пароль.
    $pass=sha1($pass."-:user:-".$ip);
    setcookie("user_name",$name,time()+86400,$path);
    setcookie("user_pass",$pass,time()+86400,$path);
}

//Удаление кукисов
function del_cookie()
{
    $name="";
    $pass="";
    $tmppos=strrpos($_SERVER["PHP_SELF"],"/") +1;
    $path=substr($_SERVER["PHP_SELF"],0,$tmppos);
    setcookie("user_name",$name,0,$path);
    setcookie("user_pass",$pass,0,$path);
}

if (isset($_POST['login']) && isset($_POST['pass']))
{
    if ($_POST['login']==$admin_login && $_POST['pass']==$admin_pass)
    {
        set_cookie($admin_login,md5($admin_pass));
    }
    header('Location: index.php');
    exit;
}
elseif(!isset($_COOKIE["user_name"]) || !isset($_COOKIE["user_pass"]))
{
    echo "<form method='POST' action='auth.php'>
            Login: <br>
            <input name='login' type='text'><br>
            Pass:<br>
            <input name='pass' type='text'><br>
            <input type='submit'>
    ";
    exit;
}
elseif($_COOKIE["user_name"]==$admin_login && $_COOKIE["user_pass"]==sha1(md5($admin_pass)."-:user:-".$ip))
{
}
else
{
    echo "<form method='POST' action='auth.php'>
            Login: <br>
            <input name='login' type='text'><br>
            Pass:<br>
            <input name='pass' type='text'><br>
            <input type='submit'>
    ";
    exit;
}
?>