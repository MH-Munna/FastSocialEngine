<?php
/* index.php */
include '../../engine/engine.inc.php';

$u = users::get(true);
$group = new groups_class($_REQUEST['group']);
$group_info = $group->get_info();

if ($group->error_no){
    die($group->error_text);
}


if (0==$group_info['i_group']){
    header('Location: /profile/'.$group_info['id']);
    die();
}
$og['info'] = $group_info;
$smarty->assign('og', $og);
$smarty->display('group/main.tpl');
var_dump($group->get_info());
