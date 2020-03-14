<?php

class BlogController{
    public static function getUserID($login_id){
        require_once("../app/model/User.php");
        $userFound = get_user("*", ['loginid'=>['=', $login_id]]);
        if($userFound==null){
            return $rows = null;
        }else {
            $user = $userFound[0];
            return $user->getField('id')->getValue();
        }
    }
    public static function getBlog($user_id){
        require_once("../app/model/Post.php");
        $rows = get_post("*",['usr_id'=>['=',$user_id]]);
        if ($rows!=null) {
            usort($rows, function ($PostEntryA, $PostEntryB) {
                $epochTimeA = $PostEntryA->getField('created_at')->getValue();
                $epochTimeB = $PostEntryB->getField('created_at')->getValue();
                if ($epochTimeA == $epochTimeB) {
                    return 0;
                }
                //Sort By desending order
                return $epochTimeA > $epochTimeB ? -1 : 1;
            });
        }
        return $rows;
    }
    public static function getBlogbyPageX($blog_info){
        get($blog_info);
        $page_no=1;
        $max_page=1;
        if($blog_info==null){
            return null;
        }else{
        $max_page = (int)(ceil(sizeof($blog_info)/5));
        }
        $top_post=0;
        $bot_post=4;
        if(isset($_GET['page'])){
            if(is_numeric(($_GET['page']))){
                $page_no = (int)$_GET['page'];
            }else{
                return ['max_page'=>$max_page];
            }
        }
        if($page_no > $max_page){
            return ['max_page'=>$max_page];
        }
        $top_post = $top_post+5*($page_no-1);
        $bot_post = $bot_post+5*($page_no-1) < sizeof($blog_info) ? $bot_post+5*($page_no-1) :sizeof($blog_info)-1;
        if($top_post==$bot_post){
            $rows = array_slice($blog_info,$top_post);
        }else {
            $rows = array_slice($blog_info, $top_post, 5);
        }
        return ['row'=>$rows,'cur_page'=>$page_no,'max_page'=>$max_page];
    }

    public static function getPost($user_id,$post_id){
        require_once("../app/model/Post.php");
        return $rows = get_post("*",['usr_id'=>['=',$user_id],'id'=>['=',$post_id]]);
    }

    public static function AddPost($blog_post){
        $title = $content = "";
        $err_msg = array();
        $loginid = $_SESSION['loginid'];
        if(isset($blog_post['title'])){
            $title = $blog_post['title'];
        }else{
            $err_msg[0] = true;
        }
        if(isset($blog_post['content'])){
            $content = $blog_post['content'];
        }else{
            $err_msg[1] = true;
        }
        if($err_msg != null){
            return $err_msg;
        }else{
            require_once('../app/model/Post.php');
            $Postvalue = [
                "title"=>$title,
                "content"=>$content,
                "created_at"=>time(),
                "updated_at"=>time(),
                "usr_id"=>self::getUserID($loginid)];
            $add_post = new Post($Postvalue);
            return $add_post->add();
        }
    }

    public static function getComments($postid)
    {
        require_once('../app/model/Comment.php');
        require_once('../app/model/User.php');
        $row = get_comment("*", ['posts_id' => ['=', $postid]]);
        $comment_array = array();
        if ($row != null) {
            usort($row, function ($CommentA, $CommentB) {
                $epochTimeA = $CommentA->getField('created_at')->getValue();
                $epochTimeB = $CommentB->getField('created_at')->getValue();
                if ($epochTimeA == $epochTimeB) {
                    return 0;
                }
                return $epochTimeA > $epochTimeB ? -1 : 1;
            });
            foreach ($row as &$comment) {
                $usr_id = $comment->getField('usr_id')->getValue();
                $loginid = get_user('*', ['id' => ['=', $usr_id]]);
                array_push($comment_array,[
                    'created_at' => $comment->getField('created_at')->getValue(),
                    'loginid' => $loginid[0]->getField('loginid')->getValue(),
                    'comment' => $comment->getField('comment')->getValue()
                ]);
            }

        }
        return $comment_array;
    }
    public static function addComments($PostID){
        require_once('../app/model/Comment.php');
        $comment = "";
        if(empty($_POST['comment'])){
            return false;
        }else{
            $comment = $_POST['comment'];
        }

        $add_comment = new Comment([
            "comment"=>$comment,
            "usr_id"=>self::getUserID($_SESSION['loginid']),
            "posts_id"=>$PostID,
            "created_at"=>time(),
        ]);
        $add_comment->add();
        return true;


    }

}