<?php
require_once('../app/controllers/BlogController.php');
require_once('../app/model/Post_Like.php');



 class LikesController{
     /**
      * Like a Post
      * @param string postid
      *
      */
     public function setLikes($postid){
         $loginid = $_SESSION['loginid'];
         $usr_id = (new BlogController())->getUserID($loginid);
         //Check if post is already liked by user
         $LikeFound = $this->getLikes(3,$usr_id,$postid);
         if(is_null($LikeFound)) {
             //User did not like post yet
             $Like_values = [
                 'usr_id' => $usr_id,
                 'posts_id' => $postid,
                 'liked_at' => time()
             ];
             $add_like = new Post_Like($Like_values);

             return $add_like->add();
         }else{
             //User has already liked the post
             return false;
         }

     }

     /**
      * remove like from post
      * 
      * 
      * @param string postid
      */
     public function RemoveLikes($postid){
         $loginid = $_SESSION['loginid'];
         $usr_id = (new BlogController())->getUserID($loginid);
         //Check if user like the post
         $like_post = ($this->getLikes(3, $usr_id,$postid));
         if(is_array($like_post)){
             ($like_post[0])->delete();
         }
     }

     /**
      * get likes base on liketype
      * 
      * @param int liketype
      * @param string usr_id
      * @param string postid
      *
      * 
      */
     public function getLikes($liketype, $usr_id = null, $postid = null){
            /* 1 : Likes of all post, 2: Like of a single Post, 3: check if user has already like the post*/
         if($liketype == 1){
             $all_usr_post = get_post('*',['usr_id'=>['=',$usr_id]]);
             $like_counter = 0;
             //Check if user has a post
             if(is_null($all_usr_post)){
                 //User has no post
                 return $like_counter;
             }
             //Add all likes from a post
             foreach($all_usr_post as &$post){
                 $like = get_post_likes('*',['posts_id'=>['=',$post->getField('id')->getValue()]]);
                 $like_counter += is_null($like) ? 0 : sizeof($like);
             }
             return $like_counter;
         }elseif($liketype == 2){
             $row = get_post_likes('*',['posts_id'=>['=',$postid]]);
             return is_null($row) ? 0 : sizeof($row);
         }elseif($liketype == 3){
             return $row = get_post_likes('*',['usr_id'=>['=',$usr_id], 'posts_id'=>['=',$postid]]);
         }

     }

 }