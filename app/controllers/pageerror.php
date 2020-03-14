<?php

class pageerror extends Router{
    public static function index(){
        self::view(['page'=>'404']);
    }

}