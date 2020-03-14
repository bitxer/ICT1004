<?php
class main extends Router{
    public static function index(){
        self::view(['page'=>'main']);
    }
}