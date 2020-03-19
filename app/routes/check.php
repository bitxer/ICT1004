<?php


class check extends Router{
    public function index(){
        $this->abort(404);
    }
    
    public function aboutus(){
        $this->view(['page'=>'aboutus']);
    }

    public function contactus(){
        $this->view(['page'=>'contactus']);
    }
}