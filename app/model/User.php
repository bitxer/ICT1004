<?php
require_once("../app/model/utils/Field.php");
require_once("../app/model/utils/Model.php");
require_once("../app/utils/helpers.php");

class User extends Model{
    const tablename = "users";
    const fields = ["loginid", "password", "email", "name", "isadmin"];
    protected $id = null;
    protected $loginid = null;
    protected $password = null;
    protected $email = null;
    protected $name = null;
    protected $isadmin = null;

    function __construct($values)
    {   
        // Initialise fields
        $this->id = new Field("id", PDO::PARAM_INT);
        $this->loginid = new Field("loginid");
        $this->password = new Field("password");
        $this->email = new Field("email");
        $this->name = new Field("name");
        $this->isadmin = new Field("isadmin", PDO::PARAM_INT);

        // Assign values
        $this->id->setValue(get($values["id"]));
        $this->loginid->setValue(get($values["loginid"]));
        $this->password->setValue(get($values["password"]));
        $this->email->setValue(get($values["email"]));
        $this->name->setValue(get($values["name"]));
        $this->isadmin->setValue(get($values["isadmin"]));
    }
}

function get_user($fields='*', $filter_by=[]){
    return get_row(User::tablename, $fields, $filter_by);
}
?>