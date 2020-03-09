<?php
class Router{
    public static function view($view, $data = []){
        require_once  '../public/' . $view . '.php';
    }

}