<?php
require_once("../app/controllers/ContactUsController.php");

class main extends Router{
    protected function index(){
        $this->view(['page'=>'main']);
    }

    protected function aboutus(){
        $this->view(['page'=>'aboutus']);
    }

    protected function contactus(){
        $this->view(['page'=>'contactus']);
    }

    protected function contact_us(){
        (new ContactUsController)->submit_us();
        header("Location: /main/contactus");
    }
}