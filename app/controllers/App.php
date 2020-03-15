<?php
class App{
    protected $controller = 'main';

    protected $method = 'index';

    protected $params = [];

    protected $url = '';

    public function __construct(){
        require_once '../app/utils/helpers.php';
        session_start();
        get($_SESSION['token']);
        if(!isset($_SESSION['token'])){
            Router::token_gen();
        }
        $this->url = $_SERVER['REQUEST_URI'];
        $this->parseUrl();
        get($this->url[1]);
        get($this->url[2]);
        $this->SetPageName();
        require_once '../app/routes/' . $this->controller . '.php';
        $this->SetMethodName();
        $this->SetParam();
        call_user_func_array([$this->controller,$this->method], $this->params);
    }

    public function parseUrl(){
        $this->url = parse_url($this->url);
        $this->url = explode('/',$this->url['path'], FILTER_SANITIZE_URL);
        unset($this->url[0]);
    }

    public function SetPageName(){
        if($this->url[1]==''){
            $this->controller = 'main';
        }elseif(file_exists('../app/routes/' . $this->url[1] . '.php')) {
            $this->controller = $this->url[1];
            unset($this->url[1]);
        }else{
            $this->controller='pageerror';
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
}