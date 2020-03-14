<?php

require_once('../app/controllers/BlogController.php');

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
                            if (!empty($_POST)) {
                                if(isset($_POST['token'])) {
                                    if($tokenmatch = Router::token_compare()){
                                        $isComAdded = BlogController::addComments($PostID = $argv[1]);
                                    }else{
                                        session_destroy();
                                        header("Location: /");
                                    }
                                }else{
                                    session_destroy();
                                    header("Location: /");
                                }
                            }
                        $post_info = BlogController::getPost($UserBlogID, $PostID = $argv[1]);
                        if ($post_info == null) {
                            self::view(['page'=>'404']);
                        } else {
                            require_once '../app/model/Post.php';
                            $comments = BlogController::getComments(($post_info[0])->getField('id')->getValue());
                            $data =[
                                'page'=>'post',
                                'post_info' => $post_info,
                                'blog_name'=>$loginid,
                                'comments'=>$comments];
                            self::view($data);
                        }
                    }else {
                        $blog_info = BlogController::getBlog($UserBlogID);
                        $blog_by_page = BlogController::getBlogbyPageX($blog_info);
                        if($blog_by_page==null){
                            self::view(['page'=>'blog', 'blog_name'=>$loginid]);
                        }elseif(!isset($blog_by_page['row'])){
                            $data=[
                                'page'=>'blog',
                                'blog_name'=>$loginid,
                                'blog_max_page'=>$blog_by_page['max_page']];
                            self::view($data);
                        }else{
                            $data = [
                                'page'=>'blog',
                                'blog_info' => $blog_by_page['row'],
                                'blog_current_page'=>$blog_by_page['cur_page'],
                                'blog_max_page'=> $blog_by_page['max_page'],
                                'blog_name' => $loginid];
                            self::view($data);
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