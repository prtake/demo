<?php
/**
 * Created by PhpStorm.
 * User: yujiabao
 * Date: 2018/9/25
 * Time: 18:09
 */
/*登录处理*/
//获取POST过来的表单数据
$username = htmlspecialchars($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
$password = md5($_POST['password']) ? md5($_POST['password']) : '';
//数据库连接文件
require '../../function.php';
//用获取的用户名密码取数据库查询数据
$sql = "select id,username,password from user where username=:username and password=:password limit 1 ";
$res1 = $pdo->prepare($sql);
$res1->execute(array(':username' => $username, ':password' => $password));
$result = $res1->fetch(PDO::FETCH_ASSOC);
//返回数据处理结果
if (!$result) {
    $res = array('status' => '0', 'message' => '用户名或密码错误!');
    echo json_encode($res);
} else {
    $_SESSION['username'] = $result['username'];
    $_SESSION['password'] = $result['password'];
    $res = array('status' => '1', 'message' => '登录成功!');
    echo json_encode($res);
}







