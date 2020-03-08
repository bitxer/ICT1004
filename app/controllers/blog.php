<?php

class blog extends Controller
{
    public static function index()
    {
        echo "blog/index";
    }

    public static function u(...$argv)
    {
        $loginid = $argv[0];

        if ($loginid == '') {
            echo "404 No user";
        } else {
            if(sizeof($argv)<=2) {
                $UserBlogID = parent::getUserID($loginid);
                if ($UserBlogID == null) {
                    echo "User not Found";
                } else {
                    if(isset($argv[1])) {
                        $post_info = parent::getPost($UserBlogID, $PostID = $argv[1]);
                        if ($post_info == null) {
                            echo "Post Not Found";
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