<?php

class signout extends Router{
    public static function index(){
        session_destroy();
        header("Location: /");
    }
}