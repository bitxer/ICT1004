<?php
class Router{
    public static function view( $data = []){
        require_once  '../public/base.php';
    }
    public static function token_gen(){
        require_once '../app/utils/helpers.php';
        get($_SESSION['token']);
        get($_SESSION['token-expire']);
        get($_SESSION['loginid']);
        if($_SESSION['token']==null){
            $length = 32;
            $_SESSION['token'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);
            $_SESSION['token-expire'] = time()+3600;
        }
    }

    public static function token_compare(){
        require_once '../app/utils/helpers.php';
        get($_SESSION['token']);
        if($_SESSION['token']==$_POST['token']){
            return self::check_session_timeout();

        }
        return false;
    }
    public static function check_session_timeout(){
        if(time()>=$_SESSION['token-expire']){
            return false;
        }else{
            return true;
        }
    }
}