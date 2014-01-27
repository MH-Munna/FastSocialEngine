<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 29.12.13
 * Time: 5:10
 */

include '../../engine/engine.inc.php';
$session_info = users::session_info();

switch($_REQUEST['action']){
    case 'getTab':
        switch($_REQUEST['tabName']){
            case 'available':
                $op['groups']['available'] = groups_class::get_all_groups_in_network();
                $smarty->assign('op', $op);
                $smarty->display('groups_tab/allAvailable.tpl');
                break;
            case 'userGroups':
                $op['groups']['userGroups'] = groups_class::get_all_userGroups(users::get()->id());
                $smarty->assign('op', $op);
                $smarty->display('groups_tab/userGroups.tpl');
                break;
        }
        break;
}

