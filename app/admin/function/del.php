<?php
/**
 * Created by PhpStorm.
 * User: yujiabao
 * Date: 2018/9/17
 * Time: 18:11
 */
/*删除数据*/
//加载数据库配置
require '../../function.php';
//接收get传值
$times = $_GET['times'] ? $_GET['times'] : '';
//编写查询语句
$sql = "select id,vdpath from video where uploadtime=:times";
$res = $pdo->prepare($sql);
$res->execute(array(':times' => $times));
//返回结果
$result = $res->fetch(PDO::FETCH_ASSOC);
//获取结果中的id
$id = $result['id'];
$path = iconv('utf-8', 'gbk', $result['vdpath']);
if ($id) {//有结果时
    //根据id删除数据
    $sql = 'delete  from video where id=:id';
    $res = $pdo->prepare($sql);
    $res->execute(array(':id' => $id));
    //获取受影响的行数
    $result = $res->rowCount();
    if ($result == 0) { //失败返回的信息
        $res1['status'] = '0';
        $res1['message'] = '删除失败';
        echo json_encode($res1);
    } else {//成功返回的信息
        unlink($path);
        $res1['status'] = '1';
        $res1['message'] = '删除成功';
        echo json_encode($res1);
    }
} else { //没有结果id时，返回错误信息
    $res1['status'] = '0';
    $res1['message'] = '没有查询到结果，删除失败';
    echo json_encode($res1);
}

