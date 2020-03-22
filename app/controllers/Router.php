<?php
require_once '../app/constants.php';
class Router{
    protected $RIGHTS = 0;
    protected $METHODS = ['GET', 'POST'];

    public function view($data = [])
    {
        require_once '../app/view/base.php';
    }

    public function token_gen()
    {
        require_once '../app/utils/helpers.php';
        if($_SESSION[SESSION_CSRF_TOKEN]==null){
            $length = 32;
            $_SESSION[SESSION_CSRF_TOKEN] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);
            $_SESSION[SESSION_CSRF_EXPIRE] = time()+3600;
        }
    }

    protected function token_compare(){
        require_once '../app/utils/helpers.php';
        if($_SESSION[SESSION_CSRF_TOKEN]==$_POST[FORM_CSRF_FIELD]){
            return $this->check_session_timeout();
        }
        return false;
    }
    public  function check_session_timeout(){
        if(time()>=$_SESSION[SESSION_CSRF_EXPIRE]){
            return false;
        } else {
            return true;
        }
    }

    public function abort($status)
    {
        http_response_code($status);
        $this->view(['page' => 'error/' . $status]);
        die();
    }

    public function __call($method, $arguments)
    {
        if ($this->RIGHTS !== $_SESSION[SESSION_RIGHTS]) {
            $this->abort(403);
        }

        if (!in_array($_SERVER['REQUEST_METHOD'], $this->METHODS, true)) {
            $this->abort(405);
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$this->token_compare()) {
            $this->abort(400);
        }
        
        return call_user_func_array(array($this,$method),$arguments);
    }
}