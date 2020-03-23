<?php
require_once("../app/controllers/AccountController.php");
require_once("../app/model/User.php");


class account extends Router
{
    protected function index()
    {
        $this->abort(404);
    }

    protected function profile()
    {
        $account_control = new AccountController();
        
        if($_SESSION[SESSION_LOGIN] != NULL){
            $user = $account_control->getdetails();
            $this->view(['page' => 'profile', 'loginid' => $user->getField('loginid')->getValue(), 'name' => $user->getField('name')->getValue(), 'email' => $user->getField('email')->getValue()]);
        }
        else{
            header("Location: /");
        }
    }

    protected function update_profile()
    {
        $account_control = new AccountController();
        $account_control->update_user();
        header("Location: /account/profile");
    }
}
