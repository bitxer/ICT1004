<?php
require_once '../app/core/RegisterController.php';
require_once '../app/utils/helpers.php';
class register extends Router{
    public static function index(){
        self::view(['page' => 'register']);
    }
    public static function register_process(){
        get($_POST['token']);
        if(self::token_compare()){
            $register = RegisterController::createUserAccount();
            if ($register == NULL){
                header("Location: /register");
            } else{
                header("Location: /login");
            }
        } else{
            session_destroy();
            header("Location: /register");
        }
    }
}