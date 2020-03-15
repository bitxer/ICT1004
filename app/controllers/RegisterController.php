<?php
require_once("../app/model/User.php");

class RegisterController
{
    public static function createUserAccount()
    {
        $confirm_pass = $_POST["confirm_password"];
        $values = [
            'loginid' => $_POST["loginid"],
            'password' => $_POST["password"],
            'email' => $_POST["email"],
            'name' => $_POST["name"],
            'isadmin' => 0
        ];
        if (empty($values['loginid'])) {
            return NULL;
        } else if (empty($values['password'])) {
            return NULL;
        } else if (strlen($values['password']) < 8) {
            var_dump(strlen($values['password']<8));
            return NULL;
        } else if (!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/i", $values['password'])) {
            return NULL;
        } 
        else if (empty($values['email'])) {
            return NULL;
        } else if (!preg_match("/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/i", $values['email'])) {
            return NULL;
        } else if (empty($values['name'])) {
            return NULL;
        } else if(empty($confirm_pass)){
            return NULL;
        } else if(strlen($confirm_pass) < 8){
            return NULL;
        } else if($confirm_pass !=$values['password']){
            return NULL;
        }
        else {
            $hash = password_hash($values['password'], PASSWORD_DEFAULT);
            $new_values=[
                'loginid' => $_POST["loginid"],
                'password' => $hash,
                'email' => $_POST["email"],
                'name' => $_POST["name"],
                'isadmin' => 0
            ];
            $user = new User($new_values);
            return $user->add();

        }
    }
}
