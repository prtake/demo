<?php
/**
 * Created by PhpStorm.
 * User: yujiabao
 * Date: 2018/9/11
 * Time: 23:27
 */
//退出登录
require '../common/function.php';
session_destroy();
$url = '../login/login.php';
header('location:' . $url);
