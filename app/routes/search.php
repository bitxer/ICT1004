<?php
require_once '../app/controllers/SearchController.php';
require_once '../app/utils/helpers.php';
class search extends Router{
    public function index(){
        if($_POST){
            $search_control = new SearchController();
            $search = $search_control->getSearchResults();
            $this->view(['page' => 'search_results','search' => $search]);
        } else{
            $this->view(['page' => 'search_results']);
        }
        
    }
}