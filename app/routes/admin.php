<?php

require_once('../app/model/User.php');

class admin extends Router{
    // protected $RIGHTS = 2;
    
    public function index(){
        self::view(['page'=>'main']);
    }

    public function u($args) {
        if (count($args))
        {
            // display specific
        } else {
            $users = get_user(['id', 'loginid', 'email', 'name', 'isadmin']);
            self::view(['page'=>'admin/users', 'users'=>$users]);
        }
    }
}