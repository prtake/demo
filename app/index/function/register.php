<?php
/**
 * Created by PhpStorm.
 * User: yujiabao
 * Date: 2018/9/25
 * Time: 18:12
 */
//获取 post的数据
$username = htmlspecialchars($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
$password = md5($_POST['password']) ? md5($_POST['password']) : '';
//获取数据库连接文件
require '../../function.php';
//查询注册的用户是否已经存在
$sql = "select id from user where username=:username";
$res = $pdo->prepare($sql);
$res->execute(array(':username' => $username));
$result = $res->fetchAll(PDO::FETCH_ASSOC);
if ($result) {
    $arr = array('status' => '0', 'message' => '用户名已存在');
    echo json_encode($arr);
} else {
    $sql1 = "insert into user(username,password) values(:username,:password) ";
    $res1 = $pdo->prepare($sql1);
    $res1->execute(array(':username' => $username, ':password' => $password));
    $result1 = $res1->fetch(PDO::FETCH_ASSOC);
    if (!$result1) {
        $arr = array('status' => '1', 'message' => '注册成功');
        echo json_encode($arr);
    } else {
        $arr = array('status' => '0', 'message' => '注册失败');
        echo json_encode($arr);
    }

}
