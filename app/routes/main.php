<?php
require_once("../app/controllers/ContactUsController.php");

class main extends Router{
    public static function index(){
        self::view(['page'=>'main']);
    }

    public static function aboutus(){
        self::view(['page'=>'aboutus']);
    }

    public static function contactus(){
        self::view(['page'=>'contactus']);
    }

    public static function contact_us(){
        ContactUsController::submit_us();
        header("Location: /main/contactus");
    }
}