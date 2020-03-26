<?php
require_once "../app/model/User.php";
require_once "../app/controllers/Router.php";

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
        if (!is_null(get_user('*', ['isadmin'=>['=', 1]]))) {
            if ($this->controller === 'setup') {
                header('Location: /', true, 301);
                die();
            }
        } else if ($this->controller !== 'setup'){
            header("Location: /setup");
        }
        require_once '../app/routes/' . $this->controller . '.php';
        $this->SetFunctionName();
        $this->SetParam();
        $function = $this->function;
        $params = $this->params;
        /*  go to /routes/<controller> and run function <function> with the following parameters <params> */           
        (new $this->controller())->$function($params);

    }
    public function StartSession(){
        session_start();
        if(!isset($_SESSION[SESSION_RIGHTS])){
            $_SESSION[SESSION_RIGHTS] = AUTH_GUEST;
        }
        if(!isset($_SESSION[SESSION_CSRF_TOKEN])){
            (new Router())->token_gen();
        }
        if(!(new Router())->check_session_timeout() && $_SESSION[SESSION_RIGHTS] > 0){
            session_destroy();
            header('Location: /?timeout=1');
            die();
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
        }elseif($this->url[1]=='main' && !isset($this->url[2])){
            header("Location: /");
        }elseif(file_exists('../app/routes/' . $this->url[1] . '.php')) {
            $this->controller = $this->url[1];
            unset($this->url[1]);
        }else{
            (new Router)->abort(404);
            die();
        }
    }

    public function SetFunctionName(){
        if(isset($this->url[2])){
            if(method_exists($this->controller, $this->url[2])){
                $this->function = $this->url[2];
                unset($this->url[2]);
            }else{
                (new Router)->abort(404);
                die();
            }
        }
    }

    public function SetParam(){
        $this->params = $this->url ? array_values($this->url) : [];
    }
}