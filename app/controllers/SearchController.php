<?php
/*
getSearchResults will first check if the POST is empty or has only a space. rows will be
returned as 0 if it is. Otherwise, it will call the get_user function from User.php
and GET the users from the table that might match the name or letters that were posted from
the search form. It will then return the array.
*/
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
