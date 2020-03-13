<?php

class signout extends Router{
    public static function index(){
        session_destroy();
        header("Location: /");
        var_dump($_SESSION);
    }
}