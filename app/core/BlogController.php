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
            usort($rows, function ($a, $b) {
                $epochA = $a->getCreated();
                $epochB = $b->getCreated();
                if ($epochA == $epochB) {
                    return 0;
                }
                //Sort By desending order
                return $epochA > $epochB ? -1 : 1;
            });
        }
        return $rows;
    }
    public static function getPost($user_id,$post_id){
        require_once("../app/model/Post.php");
        return $rows = get_post("*",['usr_id'=>['=',$user_id],'id'=>['=',$post_id]]);
    }
}