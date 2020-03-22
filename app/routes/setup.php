<?php
require_once '../app/controllers/RegisterController.php';
require_once '../app/utils/helpers.php';

class Setup extends Router{
    protected function index($args){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            self::view(["page"=>"admin/setup"]);
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $register_control = new RegisterController();
            $register_admin = $register_control->createUserAccount();
            if ($register_admin === NULL){
                $this->abort(500);
            } else{
                header("Location: /");
            }
        }
    }
}
?>