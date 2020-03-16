<?php
class pageerror extends Router{
    public function index(){
        $this->abort(404);
}
}