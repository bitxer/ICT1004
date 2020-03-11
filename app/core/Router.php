<?php
class Router{
    public static function view($view, $data = []){
        self::token_gen($view);
        require_once  '../public/' . $view . '.php';
    }
    public static function token_gen($view){
        self::get($_SESSION['internal_token']);
        self::get($_SESSION['loginid']);
        self::get($_SESSION['password']);
        self::get($_SESSION['token']);
        if($_SESSION['internal_token']==null){
            $time=time();
            $loginid=$_SESSION['loginid'];
            $password = $_SESSION['password'];
            $internal_token='t={$time}&loginid={$loginid}&password={$password}';
            $_SESSION['internal_token']=bin2hex(random_bytes(100));
        }
        $_SESSION['token'] = hash_hmac('sha256',($view . $_SESSION['loginid']),$_SESSION['internal_token']);
    }
    public static function hmac_compare(){
        self::get($_SESSION['temptoken']);
        self::get($_SESSION['token']);
        if ($_SESSION['internal_token']!=null){
            if($_SESSION['token']==$_SESSION['temptoken']){
                return true;
            }
        }
        return false;
    }

    public static function get(&$val, $default=null){
        return isset($val) ? $val : $default;
    }

}