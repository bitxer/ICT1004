<?php


class check extends Router{
    public static function index(){
        self::view(['page'=>'404']);
    }
    
    public static function aboutus(){
        self::view(['page'=>'aboutus']);
    }

    public static function contactus(){
        self::view(['page'=>'contactus']);
    }
}