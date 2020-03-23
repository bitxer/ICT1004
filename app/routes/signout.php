<?php

class signout extends Router{
    protected $RIGHTS = AUTH_LOGIN;
    protected function index(){
        session_destroy();
        $_SESSION[SESSION_RIGHTS] = AUTH_GUEST;
        header("Location: /");
    }
}