<?php
class App{
    protected $controller = 'main';

    protected $method = 'index';

    protected $params = [];

    public function __construct(){
        $url = $this->parseUrl();
        if(isset($url[1])){
            array_shift($url);
        }
        if(file_exists('../app/controllers/' . $url[0] . '.php')){
            $this->controller=$url[0];
            array_shift($url);
        }
        require_once '../app/controllers/' . $this->controller . '.php';
        if(isset($url[0])){
            if(method_exists($this->controller, $url[0])){
                $this->method = $url[0];
                array_shift($url);
            }
        }
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller,$this->method], $this->params);

    }
    public function parseUrl(){
        $url = explode('/', filter_var(rtrim($_SERVER['REQUEST_URI'],'/'),FILTER_SANITIZE_URL));
        return $url;
    }
}