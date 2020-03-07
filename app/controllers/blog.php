<?php

class blog extends Controller{
    public static function index(){
        echo "blog/index";
    }
    public static function u($loginid=''){
        if($loginid==''){
            echo "404 No user";
        }else{
            $blog_info = parent::userblog($loginid);
            if($blog_info==null){
                echo "User not Found";
            }else{
                parent::view('blog',['blog_info'=>$blog_info]);
            }
        }
    }
}