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
        if($_SESSION[SESSION_RIGHTS] == AUTH_LOGIN or $_SESSION[SESSION_RIGHTS] == AUTH_ADMIN){
            $account_control = new AccountController();
            $user = $account_control->getdetails();
            $this->view(['page' => 'profile', 'loginid' => $user->getField('loginid')->getValue(), 'name' => $user->getField('name')->getValue(), 'email' => $user->getField('email')->getValue()]);
        }
        else{
            header("Location: /");
        }
       
    }

    protected function update_profile()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($_SESSION[SESSION_RIGHTS] == AUTH_LOGIN or $_SESSION[SESSION_RIGHTS] == AUTH_LOGIN){
                $account_control = new AccountController();
                $account_control->update_user();
                header("Location: /account/profile");
            }
            else{
                header("Location: /");
            }
        }
        
        
    }
}
