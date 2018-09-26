<?php
/**
 * Created by PhpStorm.
 * User: yujiabao
 * Date: 2018/9/13
 * Time: 18:49
 */
/*上传文件*/
//连接数据库文件
require '../../function.php';

//获取POST传值
$vdtype = htmlspecialchars($_POST['vdtype']) ? htmlspecialchars($_POST['vdtype']) : '';
$vdname = htmlspecialchars($_POST['vdname']) ? htmlspecialchars($_POST['vdname']) : '';
$newNmae = iconv('utf-8', 'gbk', $vdname);
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
$message = upfile($file, $newNmae);
$vdpath = iconv('gbk', 'utf-8', $message['directory']);
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
//获取文件上传路径和错误信息
function upfile($arr, $newName)
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
    //判断上传类型是否为MP4的视频
    if ($type != 'video/mp4') {
        return array('path' => '', 'directory' => '', 'message' => '文件类型错误');
    }
    //获取点最后出现的位置
    $index = strrpos($name, '.');
    //返回一最后一个点出现位置后面的字符串，也就是获取后缀
    $ext = substr($name, $index);
    //设置要保存文件的路径
    $path = '../../../public/video/' . $time;
    //判断路劲是否存在
    if (!is_dir($path)) {
        //不存在创建路径，并返回信息
        mkdir($path);
        return array('path' => '', 'directory' => '', 'message' => '创建目录中,请刷新');
    }
    //存在则拼接文件保存名称
    $newPath = $path . '/' . $newName . $ext;
    //判断文件是否成功从临时文件保存到目标目录，并返回信息
    if (move_uploaded_file($tmp_path, $newPath)) {
        return array('path' => $path, 'directory' => $newPath, 'message' => '文件上传成功');
    } else {
        return array('path' => '', 'directory' => '', 'message' => '文件上传失败');
    }

}