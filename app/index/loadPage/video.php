<?php
/**
 * Created by PhpStorm.
 * User: yujiabao
 * Date: 2018/9/20
 * Time: 20:46
 */
$path = $_GET['path'] ? $_GET['path'] : '';
$vdname = $_GET['vdname'] ? $_GET['vdname'] : '';
require '../views/video.html';