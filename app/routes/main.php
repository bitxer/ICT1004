<?php
require_once("../app/controllers/ContactUsController.php");

class main extends Router{
    public function index(){
        $this->view(['page'=>'main']);
    }

    public function aboutus(){
        $this->view(['page'=>'aboutus']);
    }

    public function contactus(){
        $this->view(['page'=>'contactus']);
    }

    public function contact_us(){
        ContactUsController::submit_us();
        header("Location: /main/contactus");
    }
}