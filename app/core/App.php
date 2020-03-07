<?php
class App{
    protected $controller = 'main';

    protected $method = 'index';

    protected $params = [];

    protected $url = '';

    public function __construct(){
        $this->url = $_SERVER['REQUEST_URI'];
        $this->parseUrl();
        $this->get($this->url[1]);
        $this->get($this->url[2]);
        $this->SetPageName();
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->SetMethodName();
        $this->SetParam();
        call_user_func_array([$this->controller,$this->method], $this->params);

    }
    public function parseUrl(){
        $this->url = explode('/', filter_var(rtrim($this->url,'/'),FILTER_SANITIZE_URL));
        unset($this->url[0]);
    }
    public function SetPageName(){
        if(file_exists('../app/controllers/' . $this->url[1] . '.php')) {
            $this->controller = $this->url[1];
            unset($this->url[1]);
        }
    }
    public function SetMethodName(){
            if(isset($this->url[2])){
                if(method_exists($this->controller, $this->url[2])){
                    $this->method = $this->url[2];
                    unset($this->url[2]);
                }
            }
        }
    public function SetParam(){
        $this->params = $this->url ? array_values($this->url) : [];
    }
    public function get(&$val, $default=null){
        return isset($val) ? $val : $default;
    }


}