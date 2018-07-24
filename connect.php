<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2018/7/13
 * Time: 8:42
 */
    // 面向对象方式连接
    $mysqli = new mysqli('localhost','root','','imoocComment');
    if ($mysqli->errno){
        // 连接错误数>1 输出错误
        die("Connect Error: " + $mysqli->error);
    }else{
        $mysqli->set_charset("utf8");
    }