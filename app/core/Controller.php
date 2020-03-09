<?php
class Controller{
    public static function view($view, $data = []){
        require_once  '../public/' . $view . '.php';
    }

}