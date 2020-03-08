<?php

class blog extends Controller
{
    public static function index()
    {
        parent::view('404');
    }

    public static function u(...$argv){
        if (!isset($argv[0])) {
            echo "404 No user";
        } else {
            $loginid = $argv[0];
            if(sizeof($argv)<=2) {
                $UserBlogID = parent::getUserID($loginid);
                if ($UserBlogID == null) {
                    parent::view('404');
                } else {
                    if(isset($argv[1])) {
                        $post_info = parent::getPost($UserBlogID, $PostID = $argv[1]);
                        if ($post_info == null) {
                            parent::view('404');
                        } else {

                        parent::view('post', ['post_info' => $post_info]);
                        }
                    }else {
                        $blog_info = parent::getBlog($UserBlogID);
                        parent::view('blog', ['blog_info' => $blog_info, 'blog_name' => $loginid]);
                    }
                }
            }else{
                echo "error 404"; //e.g /u/test/2/randomstring
            }
        }
    }
}