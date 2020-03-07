<?php
class Controller{
    public static function view($view, $data = []){
        require_once  '../public/' . $view . '.php';
    }
    public static function userblog($login_id){
        require_once("../app/database/Connection.php");
        $db = new MySQL();
        $db->connect();
        //$userFound = $db->query('user',['uuid'],['loginid'=>['=',$login_id]]);
        $userFound = $db->query('user','*',['uuid'=>['=',$login_id]]);
        if($userFound==0){
            return $row = null;
        }else {
            return $rows = $db->query('post', '*', ['usr_uuid' => ['=', $login_id]]);
        }
    }
}