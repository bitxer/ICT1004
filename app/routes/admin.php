<?php

require_once('../app/model/User.php');
require_once('../app/model/ContactUs.php');

class admin extends Router{
    protected $RIGHTS = 2;
    
    protected function index(){
        header("Location: /admin/u");
    }

    protected function u($args) {
        if (count($args))
        {   
            $user = get_user(['id', 'loginid', 'email', 'name', 'isadmin', 'suspended'], ['id'=>['=', $args[0]]]);
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

    protected function action($args) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->abort(405);
        }

        $user = get_user('*', ['id'=>['=', $_POST['uid']]])[0];
        if ($_POST['button'] === 'promote') {
            $user->getField('isadmin')->setValue(1);
        } else if ($_POST['button'] === 'demote') {
            $user->getField('isadmin')->setValue(0);
        } else if ($_POST['button'] === 'suspend') {
            $user->getField('suspended')->setValue(1);
        } else if ($_POST['button'] === 'unsuspend') {
            $user->getField('suspended')->setValue(0);
        } else {
            $this->abort(400);
        }
        
        $result = $user->update();
        http_response_code($result === true ? 204: 500);
    }

    public function contact($args) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (count($args)) {
                $contact = get_contactus('*', ['id'=>['=', $args[0]]]);
                self::view(['page'=>'admin/contact/specific', 'contact'=>$contact]);
            } else {
                $contact = get_contactus('*');
                self::view(['page'=>'admin/contact/all', 'contact'=>$contact]);
            }
        } else if ($_SERVER['RESQUEST_METHOD'] === 'POST') {

        } else {
            $this->abort(405);
        }
    }
}