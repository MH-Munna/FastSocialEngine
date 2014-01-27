<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 27.07.13
 * Time: 1:29
 * To change this template use File | Settings | File Templates.
 */

function smarty_block_t($params, $content, $template, &$repeat)
{
    return db::create()->getlang($content);
}
?>