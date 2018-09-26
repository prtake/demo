<?php
/**
 * Created by PhpStorm.
 * User: yujiabao
 * Date: 2018/9/11
 * Time: 20:18
 */
//设置头文件
header("Content-type:text/html;charset=utf-8");
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

/*$sql = 'select id,username,passwd from user ';
$res = $pdo->prepare($sql);
$result = $res->execute();
$results = $res->fetch(PDO::FETCH_ASSOC);
print_r($results);*/
