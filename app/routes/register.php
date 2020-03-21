<?php
require_once '../app/controllers/RegisterController.php';
require_once '../app/utils/helpers.php';
/*
    register_process will call the RegisterController class's 
    createUserAccount function which will do all the validation.
    If the array $register is returned empty, it will redirect to the 
    register page with an error, otherwise it will redirect to the login page.

*/
class register extends Router{
    public function index(){
        $this->view(['page' => 'register', 'script' => '/static/js/validate.js']);
    }
    public function register_process(){
        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->abort(403);
        }
        $register_control = new RegisterController();
            $register = $register_control->createUserAccount();
            if ($register == NULL){
                header("Location: /register?error=sqlerror");
            } else{
                header("Location: /login");
            }
    }
}