<?php
session_start();
/*
 * to be delete after done (reference for handling multiple submit button
https://www.techrepublic.com/article/handling-multiple-submits-in-a-single-form-with-php/
 * 
*/

require_once("../app/model/User.php");
$_SESSION['loginid'];
$data = get_user('*');
$user = $data[0];
$currentpwd = $data[0]->getField('password')->getValue();

$errorMsg = "";
$success = true;
$uid = sanitize_input($_POST["userid"]);
$name = sanitize_input($_POST["name"]);
$cpwd = sanitize_input($_POST["cpassword"]);
$npwd = sanitize_input($_POST["npassword"]);
$ncpwd = sanitize_input($_POST["ncpassword"]);
$email = sanitize_input($_POST["email"]);
$key = '';
$val = '';
$msg = '';

switch($_POST["update"]){
    //when update user id button is pressed
    case 'buserid':
        if (empty($uid)){
            $errorMsg .= "User id is required <br>";
            $success = false;
            //break;
        }
        else{
            $key = 'loginid';
            $val = $uid;
            $msg = 'User Id';
            $success = true;
        }
        echo"update userid<br>";
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
            }
            else{
                echo $email;
                $key = 'email';
                $val = $email;
                $msg = 'Email';
                $success = true;
            }
        }
        echo"update email<br>";
        break;
        
    //when update name button is pressed.
    case 'bname':
        if (empty($name)){
            $errorMsg .= "Name is required <br>";
            $success = false;
        }
        else{
            $key = 'name';
            $val = $name;
            $msg = 'Name';
            $success = true;
        }
        echo"update name<br>";
        break;
        
    //when update password button is pressed.
    case 'bpassword':
        if(empty($cpwd) || empty($npwd) || empty($ncpwd)){
            $errorMsg.= "Password is required.";
            $success = false;
        }
        else{
            if ($cpwd == $currentpwd){
                if ($npwd == $ncpwd) {
                    $key = 'password';
                    $val = $npwd;
                    $msg = 'Password';
                    $success = true;
                } else {
                    $errorMsg .= "Password do not match.<br>";
                    $success = false;
                }
            }
            else{
                $errorMsg .= "Current password is wrong <br>";
                $success = false;
            }
        }
        echo"update password<br>";
        break;
}


if ($success){
    $values = [$key=>$val];
    foreach ($values as $key=>$val) {
        if ($val != null || $val != " "){
            $user->setValue($key, $val);
            echo "key: " . $key . " value: " . $val . "<br>";
        }
    }
    $msg .= " have been successfully updated";
    $_SESSION['msg'] = $msg;
    //$_SESSION['showmsg'] = true;
    $user->update();
    header("Location: /public/profile.php");
}
else{
    echo $errorMsg;
    $_SESSION['msg'] = $errorMsg;
    header("Location: /public/profile.php");
}

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
