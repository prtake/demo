<?php
/**
 * Created by PhpStorm.
 * User: yujiabao
 * Date: 2018/9/25
 * Time: 17:54
 */
require '../../function.php';
$vdtype1 = '综艺';
$sql = "select  id  from videotype where  vdtype =:vdtype";
$res = $pdo->prepare($sql);
$res->execute(array(':vdtype' => $vdtype1));
$result = $res->fetch(PDO::FETCH_ASSOC);
$id = $result['id'];
$sql1 = "select vdname,vdpath from video where uid=:id";
$res1 = $pdo->prepare($sql1);
$res1->execute(array(':id' => $id));
$result1 = $res1->fetchAll(PDO::FETCH_ASSOC);
$arr = $result1;
require '../views/home.html';