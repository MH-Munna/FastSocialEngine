<?php

include '../../engine/engine.inc.php';
include '../../engine/admin_include.php';

echo '<link rel="stylesheet" type="text/css" href="style.css" />';
echo '<script src="js.js"></script>';
echo '<meta charset="utf-8" />';
echo '<h1>Языковая панель</h1>';
$act=$_REQUEST['action'];
$db=db::create();

switch($act){
    case 'delete':adm_act::delete($db);
    default:adm_act::no_act($db);break;
    case 'edit':
    case 'add':adm_act::add($db);break;
}



class adm_act{
    static $cp=20;
    static $l=array(1=>'Русский','Украинский','Немецкий','Французский','Итальянский','Английский');
    static function error($text){
        return '<div style="opacity:0.5;border-radius:10px;padding:10px;margin:0 auto;width:300px;background-color:red">'.$text.'</div>';
    }
    static function access($text){
        return '<div style="opacity:0.5;border-radius:10px;padding:10px;margin:0 auto;width:300px;background-color:green">'.$text.'</div>';
    }
    static function delete($db){
        $db->query('delete from lang where id='.(int)$_REQUEST['id'].' and name="'.$_REQUEST['name'].'" ');
        echo self::error('Обект успешно удален');
    }
    static function add($db,$id=0){
        if((int)$_REQUEST['id']&&$_REQUEST['name']&&$_REQUEST['field']){
            if((int)$_REQUEST['f_id']&&$_REQUEST['f_name']){
                $db->query('update lang set id='.(int)$_REQUEST['id'].',name="'.mysql_escape_string($_REQUEST['name']).'",
                    field="'.mysql_escape_string($_REQUEST['field']).'" 
                    where id='.(int)$_REQUEST['f_id'].' and name="'.mysql_escape_string($_REQUEST['f_name']).'"');
                echo self::access('Обьект успешно изменен');
                $val=$_REQUEST;
            }else{
                $db->query('insert into lang (`id`,`name`,`field`)values(
                    '.(int)$_REQUEST['id'].',"'.mysql_escape_string($_REQUEST['name']).'","'.mysql_escape_string($_REQUEST['field']).'"
                )');
                echo self::access('Обьект успешно добавлен<br><a href="/adm/lang.php?action=edit&id='.(int)$_REQUEST['id'].'&name='.mysql_escape_string($_REQUEST['name']).'">Перейти к редактированию</a>');
                $val=$_REQUEST;
            }
        }
        elseif((int)$_REQUEST['id']&&$_REQUEST['name']){
            $sql=$db->query('select * from lang where id='.(int)$_REQUEST['id'].' and name="'.$_REQUEST['name'].'" ');
            if(!$sql)header('Location: /adm/lang.php');
            $val=$sql->fetch();
        }
        echo '<form method="post"><table cellspacing=0 cellspacing=0 id="tab_main1" width="50%">';
        echo '<input type="hidden" value="'.$val['id'].'" name="f_id">';
        echo '<input type="hidden" value="'.$val['name'].'" name="f_name">';
        echo '<tr><td align="right">Язык:</td><td><select class="inpus" name="id"><option value="0">-</option>';
        foreach(self::$l as $k=>$v){
            echo '<option '.($k==$val['id']?'selected':'').' value="'.$k.'">'.$v.'</option>';
        }
        echo '</select>';
        echo '<tr><td align="right">Идентификатор:</td><td><input class="inpus" name="name" value="'.$val['name'].'"></td>';
        echo '<tr><td align="right">Текст:</td><td><textarea class="inpus" name="field" rows=5>'.$val['field'].'</textarea></td>';
        echo '<tr><td align="right"></td><td><input class="butto" type="submit" value="сохранить"><input class="butto" type="button" value="назад" onclick="location.href=\'/adm/lang.php\'"></td>';
        
        echo '</table></form>';
    }
    static function setsession($arr){
        foreach($arr as $item){
            if(!isset($_REQUEST[$item]))$_REQUEST[$item]=$_SESSION[$item];
            $_SESSION[$item]=$_REQUEST[$item];
        }
    } 
    static function no_act($db){
        echo '<a href="/adm/lang.php?action=add">Добавить новый обьект</a><br><br>';
        $where=array();
        self::setsession(array('id_f','name_f','page','page_f'));
        
        if(!$_SESSION['page_f'])$_SESSION['page_f']=20;
        self::$cp=$_SESSION['page_f'];
        
        if($_REQUEST['id_f'])$where[]='id='.$_REQUEST['id_f'];
        if($_REQUEST['name_f'])$where[]='name like "%'.$_REQUEST['name_f'].'%"';
        if(!$pages=(int)$_REQUEST['page'])$pages=1;
        
        $page=$db->query('select count(*) from lang '.(sizeof($where)?'where '.join(' and ',$where):''))->fetch();
        $cpa=ceil($page[0]/self::$cp);
        $sql=$db->query('select * from lang '.(sizeof($where)?'where '.join(' and ',$where):'').' limit '.($pages-1)*self::$cp.','.self::$cp)->fetchAll();
        echo '<table cellspacing=0 cellspacing=0 id="tab_main" width="50%">';
        if(sizeof($sql)){
            echo '<tr><td colspan="10" align="center">';
            echo self::getpage($pages, $cpa);
            echo '</td></tr>';
        }
        //Поиск
        echo '<tr><form method="get"><td>Язык<br><select class="inpus" style="width:70px;" name="id_f"><option value="0">-</option>';
        foreach(self::$l as $k=>$v){
            echo '<option '.($k==$_REQUEST['id_f']?'selected':'').' value="'.$k.'">'.$v.'</option>';
        }
        echo '</select></td><td>
            Идентификатор<br><input class="inpus" value="'.$_REQUEST['name_f'].'" name="name_f" type="text"></td><td><input class="butto" type="submit"></td></form></tr>';
        
        if(sizeof($sql)){
        foreach($sql as $ke=>$item){
        $l_edit='/adm/lang.php?action=edit&id='.$item['id'].'&name='.$item['name'];
            echo '<tr class="'.($ke%2==0?'c1':'c2').'">
                <td class="cp" onclick="ajax(\''.$l_edit.'\')">'.self::$l[$item['id']].'</td>
                <td class="cp" onclick="ajax(\''.$l_edit.'\')">'.$item['name'].'</td>
                <td class="cp" onclick="ajax(\''.$l_edit.'\')">'.mb_substr($item['field'],0,50).(strlen($item['field'])>50?'...':'').'</td>
                <td><a title="Редактировать" href="'.$l_edit.'"><img src="edit.gif"></a></td>
                <td><a title="Удалить" href="/adm/lang.php?action=delete&id='.$item['id'].'&name='.$item['name'].'"><img src="remove.gif"></a></td>
                </tr>';
        }
        }
        else{
            echo '<tr><td colspan="10" align="center">По вашему запросу ничего не найдено</td></tr>';
        }
        echo '<tr><td colspan="10" align="center">';
        if(sizeof($sql))echo self::getpage($pages, $cpa);
        echo '</td></tr>';
        echo '</table>';
    }
    static function getcounts(){
        $arr=array(5,10,15,20,25,35,50,100);
        $sel='<span style="float:right">Отображать по <select class="inpus" style="width:70px;" name="id_f" onchange="location.href=\'/adm/lang.php?page_f=\'+this.value+\'\'"><option value="0">-</option>';
        foreach($arr as $v){
            $sel.='<option '.($v==$_SESSION['page_f']?'selected':'').' value="'.$v.'">'.$v.'</option>';
        }
        $sel.='</select></span>';
        return $sel;
    }
    static function getpage($page,$count){
        $req=explode('?',$_SERVER['REQUEST_URI']);
        if(!trim($req[1]))$link='/adm/lang.php?';
        else{
            $link=preg_replace('/(\?|\&)?page=([0-9]+)/','',$req[1]);
            $link='/adm/lang.php?'.$link.'&';
        }
        $pages='<br>Страницы: ';
            for($i=1;$i<=$count;$i++){
                if($page==$i) $pages.="<u>".$i."</u> ";
                elseif(($page-$i<=3&&$page-$i>0)||($i-$page<=3&&$i-$page>0)) $pages.="<a href='".$link."page=".$i."'>".$i."</a> ";
                elseif($i==1) $pages.="<a href='".$link."page=".$i."'>".$i."</a> .... ";
                elseif($i==$count) $pages.=".... <a href='".$link."page=".$i."'>".$i."</a>";
            }
        return $pages.self::getcounts().'<br><br>';
    }
}