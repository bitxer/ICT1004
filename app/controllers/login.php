<?php
require_once '../app/core/LoginController.php';
require_once '../app/utils/helpers.php';
class login extends Router
{
    public static function index()
    {
        self::view(['page' => 'login']);
    }
    public static function login_process()
    {
        get($_POST['token']);
        if (self::token_compare()) {
            $account = LoginController::getUserAccount();
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
