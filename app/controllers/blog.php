<?php

require_once('../app/core/BlogController.php');

class blog extends Router
{
    /**
     * Route for /blog
     * Available Routes:
     *  /blog/u/<loginid>           -Contains the Blog of a User
     *  /blog/u/<loginid>/<postid>  -Contains a Post od a User
     *  /blog/create                -Creates a Post
     */
    public static function index()
    {
        self::view(['page'=>'404']);
    }

    public static function u(...$argv){
        if (!isset($argv[0])) {
            self::view(['page'=>'404']);
        } else {
            $loginid = $argv[0];
            if(sizeof($argv)<=2) {
                $UserBlogID = BlogController::getUserID($loginid);
                if ($UserBlogID == null) {
                    self::view(['page'=>'404']);
                } else {
                    if(isset($argv[1])) {
                        $post_info = BlogController::getPost($UserBlogID, $PostID = $argv[1]);
                        if ($post_info == null) {
                            self::view(['page'=>'404']);
                        } else {
                            self::view(['page'=>'post','post_info' => $post_info, 'blog_name'=>$loginid]);
                        }
                    }else {
                        $blog_info = BlogController::getBlog($UserBlogID);
                        $blog_by_page = BlogController::getBlogbyPageX($blog_info);
                        if($blog_by_page==null){
                            self::view(['page'=>'blog', 'blog_name'=>$loginid]);
                        }elseif(!isset($blog_by_page['row'])){
                            self::view(['page'=>'blog','blog_name'=>$loginid,'blog_max_page'=>$blog_by_page['max_page']]);
                        }else{
                        self::view(['page'=>'blog','blog_info' => $blog_by_page['row'],'blog_current_page'=>$blog_by_page['cur_page'], 'blog_max_page'=> $blog_by_page['max_page'], 'blog_name' => $loginid]);
                        }
                    }
                }
            }else{
                self::view(['page'=>'404']); //e.g /u/test/2/randomstring
            }
        }
    }
    public static function create(){
        if(isset($_SESSION['token'])){
            if($_POST){
                if($token_match = Router::token_compare()){
                    $postsuccess = BlogController::AddPost($_POST);//$postsuccess returns an array if an entry is invalid, bool if it is success
                    var_dump($postsuccess);
                    if(is_bool($postsuccess)){
                        header("Location: /blog/u/" . $_SESSION['loginid']);

                    }else{
                        self::view(['page'=>'create']);
                    }
                }else{
                    session_destroy();
                    header("Location: /");
                }

            }else {
                self::view(['page'=>'create']);
            }
        }else{
            //Go back to Login
            session_destroy();
            header("Location: /");
        }
    }
}