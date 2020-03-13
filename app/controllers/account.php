<?php
require_once("../app/core/AccountController.php");
require_once("../app/model/User.php");


class account extends Router{
    public static function index(){
       self::view(['page'=>'404']);
    }
    public static function profile(){
        if($_SESSION['loginid']!=""){
        $user = AccountController::getdetails();
        self::view(['page'=>'profile','loginid'=>$user->getField('loginid')->getValue(),'name'=>$user->getField('name')->getValue(),'email'=>$user->getField('email')->getValue()]);
    }else{
        header("Location: /");
    }
}

    public static function update_profile(){
        get($_POST['token']);
        if (self::token_compare()) {
            AccountController::update_user();
            header("Location: /account/profile");
        } 
        else {
            session_destroy();
            header("Location: /");
        }
    }
}