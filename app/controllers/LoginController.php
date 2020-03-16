<?php


class LoginController
{
    public function getUserAccount()
    {
        require_once("../app/model/User.php");
        $hashed_password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $values = [
            'loginid' => ['=', $_POST["loginid"]]
        ];
        $rows = get_user("*", $values);
        if ($rows == NULL) {
            return NULL;
        } else if(password_verify($_POST['password'],$hashed_password)){
            $user = $rows[0];
            return $user->getField('loginid')->getValue();
        } else{
            return NULL;
        }
            
    }
}
