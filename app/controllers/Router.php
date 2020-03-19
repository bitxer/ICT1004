<?php
class Router{
    protected $RIGHTS = 0;
    protected $METHODS = ['GET', 'POST'];
    
    public  function view( $data = []){
        require_once  '../public/view/base.php';
    }

    public  function token_gen(){
        require_once '../app/utils/helpers.php';
        get($_SESSION['token']);
        get($_SESSION['token-expire']);
        get($_SESSION['loginid']);
        if($_SESSION['token']==null){
            $length = 32;
            $_SESSION['token'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);
            $_SESSION['token-expire'] = time()+3600;
        }
    }

    public function token_compare(){
        require_once '../app/utils/helpers.php';
        get($_SESSION['token']);
        if($_SESSION['token']==$_POST['token']){
            return $this->check_session_timeout();

        }
        return false;
    }
    public  function check_session_timeout(){
        if(time()>=$_SESSION['token-expire']){
            return false;
        }else{
            return true;
        }
    }

    public function abort($status) {
        http_response_code($status);
        $this->view(['page' => 'error/' . $status]);
        die();
    }

    public function __call($method,$arguments) {
        if($this->RIGHTS !== $_SESSION[SESSION_RIGHTS]) {
            $this->abort(403);
        }

        if (in_array($_SERVER['REQUEST_METHOD'], $this->METHODS, true)) {
            $this->abort(405);
        }
        
        return call_user_func_array(array($this,$method),$arguments);
    }
}