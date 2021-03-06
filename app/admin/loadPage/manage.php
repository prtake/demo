<?php
/**
 * Created by PhpStorm.
 * User: yujiabao
 * Date: 2018/9/12
 * Time: 18:56
 */
/*加载视频列表展示页面*/
require '../../function.php';
session_start();
//判断session的值是否存在
if (isset($_SESSION['username'])) {//存在则可以进入
    $username = $_SESSION['username'];
    //设置分页截止记录条数
    $sql = "SELECT * FROM video LEFT JOIN videotype ON video.uid = videotype.id";
    //预加载语句
    $res = $pdo->prepare($sql);
    //执行语句
    $res->execute();
    //返回结果集所有结果集
    $result = $res->fetchAll(PDO::FETCH_ASSOC);
    //加载展示页面
    require '../view/manage.html';
} else {
    //不存在则跳转到登录页面
    require 'index.php';
}





