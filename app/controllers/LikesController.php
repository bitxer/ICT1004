<?php
require_once('../app/controllers/BlogController.php');
require_once('../app/model/Post_Like.php');


 class LikesController{
     public function setLikes($postid){
         $loginid = $_SESSION['loginid'];
         $usr_id = (new BlogController())->getUserID($loginid);
         $LikeFound = $this->getLikes(3,$usr_id,$postid);
         if(is_null($LikeFound)) {
             $Like_values = [
                 'usr_id' => $usr_id,
                 'posts_id' => $postid,
                 'liked_at' => time()
             ];
             $add_like = new Post_Like($Like_values);

             return $add_like->add();
         }else{
             return false;
         }

     }

     public function RemoveLikes($postid){
         $loginid = $_SESSION['loginid'];
         $usr_id = (new BlogController())->getUserID($loginid);
         $like_post = ($this->getLikes(3, $usr_id,$postid));
         if(is_array($like_post)){
             ($like_post[0])->delete();
         }
     }

     public function getLikes($liketype, $usr_id = null, $postid = null){
            /* 1 : Likes of all post, 2: Like of a single Post, 3: check if user has already like the post*/
         if($liketype == 1){
             return $row = get_post_likes('count(*)');
         }elseif($liketype == 2){
             return $row = get_post_likes('count(*)',['posts_id'=>['=',$postid]]);
         }elseif($liketype == 3){
             return $row = get_post_likes('*',['usr_id'=>['=',$usr_id], 'posts_id'=>['=',$postid]]);
         }

     }

 }