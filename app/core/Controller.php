<?php
class Controller{
    public static function view($view, $data = []){
        require_once  '../public/' . $view . '.php';
    }
    public static function userblog($login_id){
        require_once("../app/database/Connection.php");
        $db = new MySQL();
        $db->connect();
        #$userFound = $db->query('users','*',['loginid'=>['=',$login_id]]);
        $userFound = $db->query('users','*',['id'=>['=',$login_id]]);
        if(sizeof($userFound)==0){
            return $row = null;
        }else {
            $rows = $db->query('posts', '*', ['usr_id' => ['=', $login_id]]);
            if($rows==null){
                return $rows['no post']=true;
            }else{
                return $rows;
            }
        }
    }
}