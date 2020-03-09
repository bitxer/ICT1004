<?php

require_once('../app/core/BlogController.php');

class blog extends Router
{
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

                            Router::view('post', ['post_info' => $post_info]);
                        }
                    }else {
                        $blog_info = BlogController::getBlog($UserBlogID);
                        $blog_by_page = BlogController::getBlogbyPageX($blog_info,$_POST);
                        Router::view('blog', ['blog_info' => $blog_by_page, 'blog_name' => $loginid]);
                    }
                }
            }else{
                echo "error 404"; //e.g /u/test/2/randomstring
            }
        }
    }
}