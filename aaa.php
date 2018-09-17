<?php
/**
 * Created by PhpStorm.
 * User: yujiabao
 * Date: 2018/9/12
 * Time: 12:55
 */

$arr = array('0' => array('第一', '第二', '第三'), '1' => array('第三', '第四', '第五'));
require 'aaa.html';
var_dump(unlink('public/aaa'));
?>