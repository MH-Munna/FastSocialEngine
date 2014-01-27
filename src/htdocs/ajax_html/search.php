<?php
/**
 * Скрипт который помогает искать людей и группы в сети
 * Created by PhpStorm.
 * User: Spectrum
 * Date: 14.11.13
 * Time: 16:20
 */

include '../../engine/engine.inc.php';
$session_info = users::session_info();

$q = $_REQUEST['query'];

$search = new search();
$search_result = $search->search($q);

$smarty->assign('search_result', $search_result);
$smarty->display('search/search_result.tpl');