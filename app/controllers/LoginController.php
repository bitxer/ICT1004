<?php
/*
getUserAccount will call the get_user function from User.php and 
use it against the values. It will get the users from the database and return 
an array. If the array is NULL, it will return the value of NULL.
Otherwise, it will check if the password from POST is the same with the hashed 
password in the database. It will then return the loginid, isadmin, and suspended values in an array.
*/
class LoginController
{
    public function getUserAccount()
    {
        require_once("../app/model/User.php");
        $values = [
            'loginid' => ['=', $_POST["loginid"]]
        ];
        $rows = get_user("*", $values);
        if ($rows == NULL) {
            return NULL;
        } else if(password_verify($_POST['password'],$rows[0]->getField('password')->getValue())){
            $user = $rows[0];
            $values = [
                'loginid' => $user->getField('loginid')->getValue(),
                'isadmin' => $user->getField('isadmin')->getValue(),
                'suspended' => $user->getField('suspended')->getValue()
            ];
            return $values;
        } else{
            return NULL;
        }
            
    }
}
