<?php
require_once("../app/model/ContactUs.php");

class ContactUsController{

    public function sanitize_input($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    public function submit_us(){
        $errorMsg = "";
        $success = true;
        $fname = $this->sanitize_input($_POST["fullname"]);
        $email = $this->sanitize_input($_POST["email"]);
        $description = $this->sanitize_input($_POST["description"]);
        
        
        if (empty($fname) and empty($email) and empty($description)){
            $errorMsg .= "Please fill in all required field";
            $success = false;
        }
        else{
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorMsg .= "Invalid email format.<br>";
                $success = false;
            } else {
                $success = true;
            }
        }

        if($success == true){
            $_SESSION["contactus"] = "Message successfully sent";
            $values=[
                'name' => $fname,
                'email' => $email,
                'message' => $description
            ];
            $contactus = new ContactUs($values);
            return $contactus->add();
        }
        else{
            $_SESSION["contactus"] = $errorMsg;
        }
        
    }

}