<?php

require_once('../app/model/User.php');

class admin extends Router{
    protected $RIGHTS = 2;
    
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
            self::view(['page'=>'admin/users/specific', 'user'=>$user, 'script'=>'/static/js/admin/action.js']);
        } else {
            $users = get_user(['id', 'loginid', 'email', 'name', 'isadmin']);
            self::view(['page'=>'admin/users/all', 'users'=>$users]);
        }
    }

    public function action($args) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->abort(405);
        }
        if ($_POST['button'] === 'promote') {
            $user = get_user('*', ['id'=>['=', $_POST['uid']]])[0];
            $user->getField('isadmin')->setValue(1);
            $result = $user->update();
            http_response_code($result === true ? 204: 500);
        } else if ($_POST['button'] === 'suspend') {
            $user = get_user('*', ['id'=>['=', $_POST['uid']]])[0];
            $user->getField('suspended')->setValue(1);
            $result = $user->update();
            http_response_code($result === true ? 200: 500);
        } else {
            $this->abort(400);
        }
    }

}