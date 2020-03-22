<?php

class signout extends Router{
    protected $RIGHTS = 1;
    protected function index(){
        session_destroy();
        $_SESSION[SESSION_RIGHTS] = AUTH_GUEST;
        header("Location: /");
    }
}