<?php
$template->assign('comms',comment::create()->getall($com,$type));
$template->assign('type',$type);
$template->assign('com',$com);
$template->display('comments/main.tpl');