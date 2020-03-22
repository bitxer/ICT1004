<?php
require_once("../app/controllers/AccountController.php");
require_once("../app/model/User.php");


class account extends Router {
    public function index() {
        $this->abort(404);
    }

    public function profile() {
        $account_control = new AccountController();
        if ($_SESSION['loginid'] != "") {
            $user = $account_control->getdetails();
            $this->view(['page' => 'profile', 'loginid' => $user->getField('loginid')->getValue(), 'name' => $user->getField('name')->getValue(), 'email' => $user->getField('email')->getValue()]);
        } else {
            header("Location: /");
        }
    }

    public function update_profile() {
        $account_control = new AccountController();
        if ((new Router)->token_compare()) {
            $account_control->update_user();
            header("Location: /account/profile");
        } else {
            session_destroy();
            header("Location: /");
        }
    }
}
