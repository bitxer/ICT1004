<?php
require_once '../app/controllers/RegisterController.php';
require_once '../app/utils/helpers.php';
class register extends Router{
    public function index(){
        $this->view(['page' => 'register']);
    }
    public function register_process(){
        $register_control = new RegisterController();
        get($_POST['token']);
        if($this->token_compare()){
            $register = $register_control->createUserAccount();
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