<?php
/**
 * Created by PhpStorm.
 * User: yujiabao
 * Date: 2018/9/19
 * Time: 18:07
 */
//页面加载
//导入数据库处理文件
require '../../function.php';

$sql1 = "select vdname,vdpath from video limit 0,30 ";
$res1 = $pdo->prepare($sql1);
$res1->execute();
$result1 = $res1->fetchAll(PDO::FETCH_ASSOC);
$arr = $result1;
require '../views/home.html';