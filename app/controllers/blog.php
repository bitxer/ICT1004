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
        echo "";
    }
}