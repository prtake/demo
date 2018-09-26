<?php
/**
 * Created by PhpStorm.
 * User: yujiabao
 * Date: 2018/9/25
 * Time: 16:53
 */
require '../../function.php';
//选择视频类型加载
$type = $_POST['val'];
function vdtype($type)
{
    if ($type != '首页') {
        return $type;
    } else {
        return "";
    }
}
$vdtype = vdtype($type);
echo $vdtype;
if ($vdtype != "") {
    $vdtype1 = $vdtype;
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
} else {
    $sql1 = "select vdname,vdpath from video limit 0,30 ";
    $res1 = $pdo->prepare($sql1);
    $res1->execute();
    $result1 = $res1->fetchAll(PDO::FETCH_ASSOC);
    $arr = $result1;

}

