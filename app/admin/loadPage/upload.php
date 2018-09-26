<?php
/**
 * Created by PhpStorm.
 * User: yujiabao
 * Date: 2018/9/12
 * Time: 18:23
 */
/*加载上传文件页面*/
//开启session
session_start();
//判断session的值是否存在
if (isset($_SESSION['username'])) {//存在则可以进入
    $username = $_SESSION['username'];
    require '../view/upload.html';
} else {//不存在则跳转到登录页面
    require 'index.php';
}