<?php
require_once("../app/model/utils/Field.php");
require_once("../app/model/utils/Model.php");
require_once("../app/utils/helpers.php");

class ContactUs extends Model{
    const tablename = "contact_us";
    const fields = ["id","name", "email", "message"];
    protected $id = null;
    protected $name = null;
    protected $email = null;
    protected $message = null;

    function __construct($values)
    {
        // Initialise fields
        $this->id = new Field("id", PDO::PARAM_INT);
        $this->name = new Field("name");
        $this->email = new Field("email");
        $this->message = new Field("message");

        // Assign values
        $this->id->setValue(get($values["id"]));
        $this->name->setValue(get($values["name"]));
        $this->email->setValue(get($values["email"]));
        $this->message->setValue(get($values["message"]));
    }
}

function get_contactus($fields='*', $filter_by=[]){
    return get_row('ContactUs', $fields, $filter_by);
}
?>