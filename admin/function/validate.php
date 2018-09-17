<?php
/**
 * Created by PhpStorm.
 * User: yujiabao
 * Date: 2018/9/12
 * Time: 11:15
 */
//接收POST过来的数据
$oldPassword = md5($_POST['oldPwd']) ? md5($_POST['oldPwd']) : '';
$firstPassword = md5($_POST['fisPwd']) ? md5($_POST['fisPwd']) : '';
$nextPassword = md5($_POST['nexPwd']) ? md5($_POST['nexPwd']) : '';
//连接数据库连接文件
require '../common/function.php';
//使用原密码查询数据库
$sql = "select id,passwd from user where passwd=:password";
//预定义查询
$res1 = $pdo->prepare($sql);
//执行预处理语句
$res1->execute(array(':password' => $oldPassword));
//返回结果集
$result = $res1->fetch(PDO::FETCH_ASSOC);
//保存查询到的id
$id = $result['id'];
//判断是否有结果集
if ($result) {
    //有结果集则更新数据
    $sql2 = "UPDATE user SET passwd=:newpassword where id=:id";
    $res2 = $pdo->prepare($sql2);
    //保存受影响的行数
    $result2 = $res2->execute(array(':newpassword' => $firstPassword, ':id' => $id));
    //判断是否有受影响的行数
    if ($result2) {
        //有受影响的行数则说明更新数据成功，返回信息
        $res = array('status' => '1', 'message' => '修改密码成功');
        echo json_encode($res);
    } else {
        //没有受影响的行数则说明数据库更新失败，返回信息
        $res = array('status' => '0', 'message' => '修改密码失败');
        echo json_encode($res);
    }
} else {
    //没有结果集则说明查询不到数据,返回信息
    $res = array('status' => '0', 'message' => '原密码输入错误');
    echo json_encode($res);
}




