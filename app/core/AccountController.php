<?php
require_once("../app/model/User.php");


class AccountController
{
    public static function getdetails()
    {
        $loginid = $_SESSION['loginid'];
        $data = get_user('*', ['loginid' => ["=", $loginid]]);
        return $user = $data[0];
    }

    public static function sanitize_input($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }


    public static function update_user()
    {

        $user = self::getdetails();
        

        $currentpwd = $user->getField('password')->getValue();

        $errorMsg = "";
        $success = true;
        $p = false;
        $uid = self::sanitize_input($_POST["userid"]);
        $name = self::sanitize_input($_POST["name"]);
        $cpwd = self::sanitize_input($_POST["cpassword"]);
        $npwd = self::sanitize_input($_POST["npassword"]);
        $ncpwd = self::sanitize_input($_POST["ncpassword"]);
        $email = self::sanitize_input($_POST["email"]);
        $key = '';
        $val = '';
        $msg = '';

        switch ($_POST["update"]) {
                //when update user id button is pressed
            case 'buserid':
                if (empty($uid)) {
                    $errorMsg .= "User id is required <br>";
                    $success = false;
                    //break;
                } else {
                    $key = 'loginid';
                    $val = $uid;
                    $msg = 'User Id';
                    $success = true;
                }
                echo "update userid<br>";
                break;

                //when update email button is press
            case 'bemail':
                if (empty($email)) {
                    $errorMsg .= "Email is required.<br>";
                    $success = false;
                    //break;
                } else {
                    // Additional check to make sure e-mail address is well-formed.
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errorMsg .= "Invalid email format.<br>";
                        $success = false;
                    } else {
                        echo $email;
                        $key = 'email';
                        $val = $email;
                        $msg = 'Email';
                        $success = true;
                    }
                }
                echo "update email<br>";
                break;

                //when update name button is pressed.
            case 'bname':
                if (empty($name)) {
                    $errorMsg .= "Name is required <br>";
                    $success = false;
                } else {
                    $key = 'name';
                    $val = $name;
                    $msg = 'Name';
                    $success = true;
                }
                echo "update name<br>";
                break;

                //when update password button is pressed.
            case 'bpassword':
                if (empty($cpwd) || empty($npwd) || empty($ncpwd)) {
                    $errorMsg .= "Password is required.";
                    $success = false;
                } else {
                    if ($cpwd == $currentpwd) {
                        if ($npwd == $ncpwd) {
                            $key = 'password';
                            $val = $npwd;
                            $msg = 'Password';
                            $p = true;
                            $success = true;
                        } else {
                            $errorMsg .= "Password do not match.<br>";
                            $success = false;
                        }
                    } else {
                        $errorMsg .= "Current password is wrong <br>";
                        $success = false;
                    }
                }
                echo "update password<br>";
                break;
        }


        if ($success) {
            $_SESSION['loginid'] = $uid == "" ? $_SESSION['loginid'] : $uid;
            $values = [$key => $val];
            foreach ($values as $key => $val) {
                if ($val != null || $val != " ") {
                    $user->setValue($key, $val);
                }
            }
            $msg .= " have been successfully updated";
            $_SESSION['msg'] = $msg;
            $user->update();
            if($p == true){
                unset($_SESSION['loginid']);
            }
        } else {
            $_SESSION['msg'] = $errorMsg;
        }

        //Helper function that checks input for malicious or unwanted content.

    }
}
