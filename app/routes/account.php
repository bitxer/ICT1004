<?php
require_once("../app/controllers/AccountController.php");
require_once("../app/model/User.php");



class account extends Router
{
    protected $RIGHTS = AUTH_LOGIN;
    protected function index()
    {
        $this->abort(404);
    }

    protected function profile()
    {
        $account_control = new AccountController();
        $user = $account_control->getdetails();
        if ($user == NULL) {
            $this->abort(400);
        }
        $this->view(['page' => 'profile', 'loginid' => $user->getField('loginid')->getValue(), 'name' => $user->getField('name')->getValue(), 'email' => $user->getField('email')->getValue()]);
    }

    protected function update_profile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $account_control = new AccountController();
            if ($account_control->update_user() === false) {
                $_SESSION['msg'] = 'An unexpected error occurred';
            }
            header("Location: /account/profile");
        } else {
            $this->abort(405);
        }
    }
}
