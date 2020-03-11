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
        Router::view('404');
    }

    public static function u(...$argv){
        if (!isset($argv[0])) {
            Router::view('404');
        } else {
            $loginid = $argv[0];
            if(sizeof($argv)<=2) {
                $UserBlogID = BlogController::getUserID($loginid);
                if ($UserBlogID == null) {
                    Router::view('404');
                } else {
                    if(isset($argv[1])) {
                        $post_info = BlogController::getPost($UserBlogID, $PostID = $argv[1]);
                        if ($post_info == null) {
                            Router::view('404');
                        } else {
                            Router::view('post', ['post_info' => $post_info, 'blog_name'=>$loginid]);
                        }
                    }else {
                        $blog_info = BlogController::getBlog($UserBlogID);
                        $blog_by_page = BlogController::getBlogbyPageX($blog_info);
                        if(!isset($blog_by_page['row'])){
                            Router::view('blog',['blog_name'=>$loginid,'blog_max_page'=>$blog_by_page['max_page']]);
                        }else{
                        Router::view('blog', ['blog_info' => $blog_by_page['row'],'blog_current_page'=>$blog_by_page['cur_page'], 'blog_max_page'=> $blog_by_page['max_page'], 'blog_name' => $loginid]);
                        }
                    }
                }
            }else{
                Router::view('404'); //e.g /u/test/2/randomstring
            }
        }
    }
    public static function create(){
        if(!isset($_SESSION['internal-token'])){
            if($_POST){
                //validate Post
                Router::get($_SESSION['temptoken']);
                $_SESSION['temptoken'] = Router::get($_POST['token']);
                if($hmacsuccess = Router::hmac_compare()){
                    $postsuccess = BlogController::AddPost($_POST);//$postsuccess returns an array if an entry is invalid, bool if it is success
                    var_dump($postsuccess);
                    if(is_bool($postsuccess)){
                        header("Location: /blog/u/" . $_SESSION['loginid']);

                    }else{
                        Router::view('create');
                    }
                }else{
                    session_destroy();
                    header("Location: /");
                }

            }else {
                Router::view('create');
            }
        }else{
            //Go back to Login
            header("Location: /");
        }
    }
}