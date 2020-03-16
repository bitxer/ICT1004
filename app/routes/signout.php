<?php

class signout extends Router{
    protected $RIGHTS = 1;
    public static function index(){
        session_destroy();
        header("Location: /");
    }
}