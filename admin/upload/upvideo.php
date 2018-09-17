<?php
/**
 * Created by PhpStorm.
 * User: yujiabao
 * Date: 2018/9/13
 * Time: 18:49
 */
//连接数据库文件
require '../common/function.php';

//获取POST传值
$vdtype = htmlspecialchars($_POST['vdtype']) ? htmlspecialchars($_POST['vdtype']) : '';
$vdname = htmlspecialchars($_POST['vdname']) ? htmlspecialchars($_POST['vdname']) : '';
//查询电影类型是否存在
$sql1 = 'select id from videotype where vdtype=:vdtype';
$res1 = $pdo->prepare($sql1);
$res1->execute(array(':vdtype' => $vdtype));
$result1 = $res1->fetch(PDO::FETCH_ASSOC);
//判断视频类型是否存在
if (!isset($result1['id'])) { //不存在视频类型则新建视频类型
    $sql3 = "INSERT INTO videotype(vdtype) VALUES (:vdtype)";
    $res3 = $pdo->prepare($sql3);
    $result3 = $res3->execute(array(':vdtype' => $vdtype));
    if (isset($result3)) {
        echo '新建视频类型';
    } else {
        $res = array('status' => '0', 'message' => '新建视频类型失败无法上传视频');
        echo json_encode($res);
    }
}
//分类存在则添加视频
$uid = $result1['id'];
$times = date('Y-m-d H:i:s');
//上传文件的处理函数
$file = $_FILES['file'];
$message = upfile($file);
$vdpath = $message['directory'];
$path = $message['path'];
//判断返回的数据是否是路径
if (is_dir($path)) {
    $sql2 = 'INSERT INTO video( vdname,vdpath,uploadtime,uid) VALUES (:vdname,:vdpath,:times,:uid)';
    $res2 = $pdo->prepare($sql2);
    $result2 = $res2->execute(array(':vdname' => $vdname, ':times' => $times, ':vdpath' => $vdpath, ':uid' => $uid));
//视频类型存在则写入数据，写入成功与失败返回信息
    if (isset($result2)) {
        $res = array('status' => '1', 'message' => $message['message']);
        echo json_encode($res);
    } else {
        $res = array('status' => '0', 'message' => '视频上传失败');
        echo json_encode($res);
    }
} else {
    //不是路径就返回错误信息
    $res = array('status' => '0', 'message' => $message['message']);
    echo json_encode($res);
}
