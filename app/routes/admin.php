<?php

require_once('../app/model/User.php');
require_once('../app/model/ContactUs.php');

/**
 * Route for /admin endpoints
 */
class admin extends Router{
    protected $RIGHTS = AUTH_ADMIN;

    /**
     * Redirects to /admin/u if no subpath is specified
     */
    protected function index(){
        header("Location: /admin/u");
    }

    /**
     * Endpoint to retrieve all or specific user details
     * Endpoint only allows GET
     */
    protected function u($args) {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET'){
            $this->abort(405);
        }

        if (count($args))
        {   
            $user = get_user(['id', 'loginid', 'email', 'name', 'isadmin', 'suspended'], ['id'=>['=', $args[0]]]);
            if ($user == null) {
                $this->abort(404);
            }
            if (count($user) > 1) {
                $user = $user[0];
            }
            self::view(['page'=>'admin/users/specific', 'user'=>$user, 'script'=>'/static/js/admin/action.js']);
        } else {
            $users = get_user(['id', 'loginid', 'email', 'name', 'isadmin', 'suspended']);
            self::view(['page'=>'admin/users/all', 'users'=>$users]);
        }
    }

    /**
     * Endpoint to promote, demote, suspend or unsuspend user account
     * Endpoint only allows POST
     */
    protected function action($args) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
            $this->abort(405);
        }
        
        $user = get_user('*', ['id'=>['=', $_POST['uid']]])[0];
        if ($_POST['button'] === 'promote') {
            $user->getField('isadmin')->setValue(1);
        } else if ($_POST['button'] === 'demote') {
            $user->getField('isadmin')->setValue(0);
        } else if ($_POST['button'] === 'suspend') {
            $user->getField('suspended')->setValue(1);
        } else if ($_POST['button'] === 'unsuspend') {
            $user->getField('suspended')->setValue(0);
        } else {
            $this->abort(400);
        }
        
        $result = $user->update();
        http_response_code($result === true ? 204: 500);
    }

    /**
     * Endpoint to retrieve all or specific contact request information.
     * Endpoint only allows GET
     */
    protected function contact($args) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (count($args)) {
                $contact = get_contactus('*', ['id'=>['=', $args[0]]]);
                if ($contact === NULL){
                    $this->abort(404);
                }
                self::view(['page'=>'admin/contact/specific', 'contact'=>$contact, 'script'=>'/static/js/admin/action.js']);
            } else {
                $contact = get_contactus('*');
                self::view(['page'=>'admin/contact/all', 'contact'=>$contact]);
            }
        } else {
            $this->abort(405);
        }
    }

    /**
     * Endpoint to delete contact requests
     * Endpoint only allows POST
     */
    protected function delete($args) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
            $this->abort(405);
        }
        $contact = get_contactus('*', ['id'=>['=', $_POST["id"]]])[0];
        if ($contact === NULL) {
            $this->abort(404);
        }
        if  ($contact->delete() === true) {
            header("Location: /admin/contact");
        } else {
            $this->abort(400);
        }
    }
}