<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2018/7/13
 * Time: 8:40
 */
    header("content-type:text/html;charset=utf-8");
    require_once 'connect.php';
    require_once 'comment.class.php';
    $arr = array();
    $res = Comment::validate($arr);
    if ($res){
        $sql = "insert into comments(username,email,url,face,content,pubTime) values(?,?,?,?,?,?);";
        // 预处理
        $mysqli_stmt = $mysqli->prepare($sql);
        $arr['pubTime'] = time();
        // 绑定参数
        $mysqli_stmt->bind_param("sssssi",$arr['username'],$arr['email'],$arr['url'],$arr['face'],$arr['content'],$arr['pubTime']);
        $mysqli_stmt->execute();
        $comment = new Comment($arr);
        // 返回给前端进行显示
        echo json_encode(array('status'=>1,'html'=>$comment->output()));
    }else{
        echo '{"status":0,"errors":'.json_encode($arr).'}';
    }
