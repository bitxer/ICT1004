<?php
class App{
    protected $controller = 'main';

    protected $function = 'index';

    protected $params = [];

    protected $url = '';

    public function __construct(){
        require_once '../app/utils/helpers.php';
        $this->StartSession();
        $this->url = $_SERVER['REQUEST_URI'];
        $this->parseUrl();
        get($this->url[1]);
        get($this->url[2]);
        $this->SetPageName();
        require_once '../app/routes/' . $this->controller . '.php';
        $this->SetFunctionName();
        $this->SetParam();
        $function = $this->function;
        $params = $this->params;
        /*  go to /routes/<controller> and run function <function> with the following parameters <params>*/
        (new $this->controller())->$function($params);
    }
    public function StartSession(){
        session_start();
        get($_SESSION['token']);
        if(!isset($_SESSION['token'])){
            (new Router())->token_gen();
        }else{
            if(time()>$_SESSION['token-expire']){
                if(!is_null($_SESSION['loginid'])){
                    require_once '../app/routes/signout.php';
                    $this->controller = 'signout';
                    $function = 'index';
                    (new $this->controller())->$function();
                }
            }
        }
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

    public function SetFunctionName(){
        if(isset($this->url[2])){
            if(method_exists($this->controller, $this->url[2])){
                $this->function = $this->url[2];
                unset($this->url[2]);
            }
        }
    }

    public function SetParam(){
        $this->params = $this->url ? array_values($this->url) : [];
    }
}