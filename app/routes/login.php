<?php
require_once '../app/controllers/LoginController.php';
require_once '../app/utils/helpers.php';
class login extends Router
{
    public function index()
    {
        $this->view(['page' => 'login']);
    }
    public function login_process()
    {
        $login_control = new LoginController();
        get($_POST['token']);
        if ($this->token_compare()) {
            $account = $login_control->getUserAccount();
            if ($account == NULL) {
                header("Location: /login");
            } else {
                $_SESSION['loginid'] = $account;
                header("Location: /blog/u/" . $_SESSION['loginid']);
            }
        } else {
            session_destroy();
            header("Location: /login");
        }
    }
}
