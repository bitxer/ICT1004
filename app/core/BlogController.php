<?php

class BlogController{
    public static function getUserID($login_id){
        require_once("../app/model/User.php");
        $userFound = get_user("*", ['loginid'=>['=', $login_id]]);
        if($userFound==null){
            return $rows = null;
        }else {
            return $userFound[0]->getID();
        }
    }
    public static function getBlog($user_id){
        require_once("../app/model/Post.php");
        $rows = get_post("*",['usr_id'=>['=',$user_id]]);
        if ($rows!=null) {
            usort($rows, function ($PostEntryA, $PostEntryB) {
                $epochTimeA = $PostEntryA->getCreated();
                $epochTimeB = $PostEntryB->getCreated();
                if ($epochTimeA == $epochTimeB) {
                    return 0;
                }
                //Sort By desending order
                return $epochTimeA > $epochTimeB ? -1 : 1;
            });
        }
        return $rows;
    }
    public static function getBlogbyPageX($blog_info, $post){
        $page_no=1;
        if(isset($post['page'])){
            if(is_numeric(($post['page']))){
                $page_no = (int)$post['page'];
            }else{
                return null;
            }
        }
        if((5*$page_no-4) > sizeof($blog_info)){
            return null;
        }
        $top_post = 5*($page_no-1);
        $bot_post = (5*($page_no)+5)<sizeof($blog_info) ? sizeof($blog_info) : $page_no*5 ;
        $rows = array_slice($blog_info,$top_post,$bot_post);
        return $rows;
    }

    public static function getPost($user_id,$post_id){
        require_once("../app/model/Post.php");
        return $rows = get_post("*",['usr_id'=>['=',$user_id],'id'=>['=',$post_id]]);
    }

}