<?php


class LoginController
{
    public static function getUserAccount()
    {
        require_once("../app/model/User.php");
        $values = [
            'loginid' => ['=', $_POST["loginid"]],
            'password' => ['=', $_POST["password"]]
        ];
        $rows = get_user("*", $values);
        if ($rows == NULL) {
            return NULL;
        } else {
            $user = $rows[0];
            return $user->getField('loginid')->getValue();
        }
    }
}
