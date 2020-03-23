<?php
/*
Check if $_POST is set. If it is, call the getSearchResults function
from the SearchController.
*/
require_once '../app/controllers/SearchController.php';
require_once '../app/utils/helpers.php';
class search extends Router{
    protected $RIGHTS = AUTH_LOGIN;
    protected function index(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $search_control = new SearchController();
            $search = $search_control->getSearchResults();
            $this->view(['page' => 'search_results','search' => $search]);
        } else{
            $this->view(['page' => 'search_results']);
        }
        
    }
}