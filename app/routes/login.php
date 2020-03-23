<?php
require_once '../app/controllers/LoginController.php';
require_once '../app/utils/helpers.php';
/*
 login_process will call the LoginController class's getUserAccount
 function. If the array returned is NULL,  redirect to login page with 
 invalid credentials error. If account is suspended, redirect to login page 
 with account locked error. If it's an admin account, redirect to admin page.
 Otherwise, redirect to the user's blog page.
*/
class login extends Router
{
    protected function index()
    {
        $this->view(['page' => 'login']);
    }
    protected function login_process()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->abort(403);
        }
        $login_control = new LoginController();

        $account = $login_control->getUserAccount();
        if ($account == NULL) {
            header("Location: /login?error=invalidcredentials");
        } else if ($account['isadmin'] == 1) {
            $_SESSION[SESSION_RIGHTS] = AUTH_ADMIN;
            $_SESSION[SESSION_LOGIN] = $account['loginid'];
            $_SESSION[SESSION_CSRF_EXPIRE] = time() + 3600;
            header("Location: /admin");
        } else if ($account['suspended'] == 1) {
            header("Location: /login?error=accountlocked");
        } else {
            $_SESSION[SESSION_LOGIN] = $account['loginid'];
            $_SESSION[SESSION_CSRF_EXPIRE] = time() + 3600;
            $_SESSION[SESSION_RIGHTS] = AUTH_LOGIN;
            header("Location: /blog/u/" . $_SESSION[SESSION_LOGIN]);
        }
    }
}
