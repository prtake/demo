<?php
/**
 * Created by PhpStorm.
 * User: yujiabao
 * Date: 2018/9/11
 * Time: 20:18
 */
//设置头文件
header("Content-type:text/html;charset=utf-8");
//开启session
session_start();
//设置两家数据库的数据
$dsn = "mysql:host=localhost;dbname=wuwo";
$user = "root";
$pwd = "root";
//获取连接数据库是否成功
try {
    $pdo = new PDO($dsn, $user, $pwd);
} catch (PDOException $e) {
    echo '数据库连接失败：' . $e->getMessage();
}

//获取文件上传路径和错误信息
function upfile($arr)
{
    //设置文件信息
    $name = $arr['name'];
    $tmp_path = $arr['tmp_name'];
    $size = $arr['size'];
    $error = $arr['error'];
    $type = $arr['type'];
    $time = date('Ymd');
    //判断是不是通过http post请求上传的数据
    if (!is_uploaded_file($tmp_path)) {
        return array('path' => '', 'directory' => '', 'message' => '非法上传');
    }
    //判断返回的错误信息0表示没有错误
    if ($error != 0) {
        return array('path' => '', 'directory' => '', 'message' => '文件上传有误');
    }
    //获取点最后出现的位置
    $index = strrpos($name, '.');
    //返回一最后一个点出现位置后面的字符串，也就是获取后缀
    $ext = substr($name, $index);
    //设置要保存文件的路径
    $path = '../../public/video/' . $time;
    //判断路劲是否存在
    if (!is_dir($path)) {
        //不存在创建路径，并返回信息
        mkdir($path);
        return array('path' => '', 'directory' => '', 'message' => '创建目录中,请刷新');
    }
    //存在则拼接文件保存名称
    $newPath = $path . '/' . uniqid() . $ext;
    //判断文件是否成功从临时文件保存到目标目录，并返回信息
    if (move_uploaded_file($tmp_path, $newPath)) {
        return array('path' => $path, 'directory' => $newPath, 'message' => '文件上传成功');
    } else {
        return array('path' => '', 'directory' => '', 'message' => '文件上传失败');
    }

}
/*$sql = 'select id,username,passwd from user ';
$res = $pdo->prepare($sql);
$result = $res->execute();
$results = $res->fetch(PDO::FETCH_ASSOC);
print_r($results);*/
