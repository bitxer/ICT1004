<?php
class App{
    protected $controller = 'main';

    protected $method = 'index';

    protected $params = [];

    protected $url = '';

    public function __construct(){
        $this->url = $_SERVER['REQUEST_URI'];
        $this->parseUrl();
        $this->SetPageName();
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->SetMethodName();
        $this->SetParam();
        call_user_func_array([$this->controller,$this->method], $this->params);

    }
    public function parseUrl(){
        $this->url = explode('/', filter_var(rtrim($this->url,'/'),FILTER_SANITIZE_URL));
        array_shift($this->url);
    }
    public function SetPageName(){
        if(file_exists('../app/controllers/' . $this->url[0] . '.php')) {
            $this->controller = $this->url[0];
            array_shift($this->url);
        }
    }
    public function SetMethodName(){
            if(isset($this->url[0])){
                if(method_exists($this->controller, $this->url[0])){
                    $this->method = $this->url[0];
                    array_shift($this->url);
                }
            }
        }
    public function SetParam(){
        $this->params = $this->url ? array_values($this->url) : [];
    }


}