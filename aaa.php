<?php
/**
 * Created by PhpStorm.
 * User: yujiabao
 * Date: 2018/9/12
 * Time: 12:55
 */
function upVideo($file, $wjm)
{
//获取文件上传的信息
    $name = $file['name'];
    $path = $file['tmp_name'];
    $size = $file['size'];
    $type = $file['type'];
    $error = $file['error'];
    $time = date('Ymd');
//判断文件是否是http post上传
    if (!$path) {
        return '非法上传';
    }
    if ($error != 0) {
        require '文件上传失败';
    }
//获取文件名称中第一个点出现的位置
    $dian = strrpos($name, '.');
//截取从点开始后面的字符
    $houzui = substr($name, $dian);
//设置保存路径
    $bpath = 'aaa/' . $time;
//如果路劲不存在
    if (!is_dir($bpath)) {
        //创建路径
        mkdir($bpath);
        return '创建路径中';
    }
    $newPath = $bpath . '/' . $wjm . $houzui;
//判断文件是否从临时文件移出
    if (move_uploaded_file($path, $newPath)) {
        return '文件上传成功';
    } else {
        return '文件上传失败';
    }
}

$wjm = $_POST['name'] ? $_POST['name'] : '我是';
$file = $_FILES['file'];
echo $wjm;
print_r($file);
$res = upVideo($file, $wjm);
echo $res;
?>