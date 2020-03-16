<?php
class main extends Router{
    public function index(){
        $this->view(['page'=>'main']);
    }
}