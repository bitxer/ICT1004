<?php
require_once("../app/model/User.php");
require_once("../app/constants.php");

class AccountController
{
    public function getdetails()
    {
        if($_SESSION[SESSION_RIGHTS] == AUTH_LOGIN || $_SESSION[SESSION_RIGHTS] == AUTH_ADMIN){
            $loginid = $_SESSION[SESSION_LOGIN];
            $data = get_user('*', ['loginid' => ["=", $loginid]]);
            return $data == NULL ? NULL : $data[0];
        } else {
            return NULL;
        }
    }

    public function sanitize_input($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }


    public function update_user()
    {

        $user = $this->getdetails();
        

        $currentpwd = $user->getField('password')->getValue();
        $errorMsg = "";
        $success = true;
        $p = false;
        $uid = $this->sanitize_input($_POST["userid"]);
        $name = $this->sanitize_input($_POST["name"]);
        $cpwd = $this->sanitize_input($_POST["cpassword"]);
        $npwd = $this->sanitize_input($_POST["npassword"]);
        $ncpwd = $this->sanitize_input($_POST["ncpassword"]);
        $email = $this->sanitize_input($_POST["email"]);
        $key = '';
        $val = '';
        $keyval = (array) null;
        $msg = '';
        
        if ($uid != $_SESSION[SESSION_LOGIN]){
            if (get_user('*', ['loginid' => ["=", $uid]]) !== NULL) {
                $_SESSION['msg'] = "A user with the given User ID already exists";
                return;
            }
        }
        
        switch ($_POST["update"]) {
                //when update user id button is pressed
            case 'bprofile':
                if (empty($uid)) {
                    $errorMsg .= "User id is required <br>";
                    $success = false;
                } else {
                    $keyval['loginid'] = $uid;
                    $msg = 'Profile';
                    $success = $success && true;
                }

                if (empty($email)) {
                    $errorMsg .= "Email is required.<br>";
                    $success = false;
                } else {
                    // Additional check to make sure e-mail address is well-formed.
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errorMsg .= "Invalid email format.<br>";
                        $success = false;
                    } else {
                        $keyval['email'] = $email;
                        $msg = 'Profile';
                        $success = $success && true;
                    }
                }

                if (empty($name)) {
                    $errorMsg .= "Name is required <br>";
                    $success = false;
                } else {
                    $keyval['name'] = $name;
                    $msg = 'Profile';
                    $success = $success && true;
                }
                break;
                
            case 'bpassword':
                if (empty($cpwd) || empty($npwd) || empty($ncpwd)) {
                    $errorMsg .= "Password is required.";
                    $success = false;
                } else {
                    if (password_verify($cpwd,$currentpwd)) {
                        if ($npwd == $ncpwd) {
                            $keyval['key'] = password_hash($npwd, PASSWORD_DEFAULT);
                            $msg = 'Password';
                            $p = true;
                            $success = true;
                        } else {
                            $errorMsg .= "New password do not match.<br>";
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
            foreach ($keyval as $key => $val) {
                if ($val != null || $val != " ") {
                    $user->setValue($key, $val);
                }
            }
            
            $_SESSION[SESSION_LOGIN] = $uid == "" ? $_SESSION[SESSION_LOGIN] : $uid;
            $msg .= " have been successfully updated <br>";
            if($p == true){
                $msg.="Your updated password will take effect after next login";
            }
            $_SESSION['msg'] = $msg;
            return $user->update();
        } else {
            $_SESSION['msg'] = $errorMsg;
        }
    }
}
