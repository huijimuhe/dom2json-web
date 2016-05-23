<?php

header("Content-Type:text/html;charset=utf-8");
error_reporting(E_ERROR | E_WARNING);
date_default_timezone_set("Asia/chongqing");
include "Uploader.class.php";

//上传配置
$config = array(
    "maxSize" => 1000, //允许的文件最大尺寸，单位KB
    "allowFiles" => [".png", ".jpg"] //允许的文件格式
);

//上传文件
$up = new Uploader("upfile", $config);
$type = $_REQUEST['type'];
$callback = $_GET['callback'];

//获取结果
$info = $up->getFileInfo();

//返回结果
if ($callback) {
    echo '<script>' . $callback . '(' . json_encode($info) . ')</script>';
} else {
    echo json_encode($info);
}
