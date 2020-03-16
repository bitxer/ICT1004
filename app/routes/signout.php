<?php

class signout extends Router{
    protected $RIGHTS = 1;
    public function index(){
        session_destroy();
        header("Location: /");
    }
}