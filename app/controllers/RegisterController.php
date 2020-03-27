<?php
require_once("../app/model/User.php");
require_once("../app/controllers/BlogController.php");

class RegisterController
{
    public function createUserAccount()
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
            if(($userFound = get_user("*", ['loginid'=>['=', $_POST['loginid']]]))!=NULL){
                return NULL;
            }

            $hash = password_hash($values['password'], PASSWORD_DEFAULT);
            $new_values=[
                'loginid' => $_POST["loginid"],
                'password' => $hash,
                'email' => $_POST["email"],
                'name' => $_POST["name"],
                'isadmin' => 0
            ];
            if ($_SERVER['REQUEST_URI'] === '/setup') {
                $new_values['isadmin'] = 1;
            }
            $user = new User($new_values);
            return $user->add();
        }
    }
}
