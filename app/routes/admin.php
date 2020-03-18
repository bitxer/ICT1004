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
            $user = get_user(['id', 'loginid', 'email', 'name', 'isadmin'], ['id'=>['=', $args[0]]]);
            if ($user == null) {
                $this->abort(404);
            }
            if (count($user) > 1) {
                $user = $user[0];
            }
            self::view(['page'=>'admin/users/specific', 'user'=>$user]);
        } else {
            $users = get_user(['id', 'loginid', 'email', 'name', 'isadmin']);
            self::view(['page'=>'admin/users/all', 'users'=>$users]);
        }
    }
}