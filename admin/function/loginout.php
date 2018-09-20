<?php
/**
 * Created by PhpStorm.
 * User: yujiabao
 * Date: 2018/9/11
 * Time: 23:27
 */
/*退出登录*/
require '../common/function.php';
session_destroy();
unset($_SESSION);
require '../loadPage/index.php';

