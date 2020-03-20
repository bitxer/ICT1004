<?php

class SearchController{
    public function getSearchResults(){
        require_once('../app/model/User.php');
        $login_id = htmlspecialchars($_POST['search']); 
        if(empty($login_id) || ctype_space($login_id)){
            return $rows = 0;
        }else{
            $userFound = get_user("*",['loginid'=>['LIKE','%' . $login_id . '%']]);
            if($userFound == null){
                return $rows = 0;
            } else{
                return $userFound;
            }
        }
        
    }
}
