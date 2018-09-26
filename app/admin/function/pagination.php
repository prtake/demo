<?php
/**
 * Created by PhpStorm.
 * User: yujiabao
 * Date: 2018/9/21
 * Time: 0:16
 */
/*分页处理*/

//获取连接数据库文件
require '../../function.php';
//编写SQL语句
$sql = 'select id from video ';
$res = $pdo->prepare($sql);
$res->execute();
//得到记录条数
$result = $res->rowCount();
//设置每页显示条数
$pageAmount = '3';
//获取分页数
$pageTotal = ceil($result / $pageAmount);
$arr = array('pageAmount' => $pageAmount, 'pageTotal' => $pageTotal, 'dataTotal' => $result);
echo json_encode($arr);
