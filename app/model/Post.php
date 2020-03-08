<?php
require_once("../app/model/utils/Field.php");
require_once("../app/model/utils/Model.php");
require_once("../app/utils/helpers.php");

class Post extends Model{
    const tablename = "posts";
    const fields = ["title", "content", "created_at", "updated_at"];
    protected $id = null;
    protected $title = null;
    protected $content = null;
    protected $created_at = null;
    protected $updated_at = null;
    protected $usr_id = null;

    function __construct($values)
    {   
        // Initialise fields
        $this->id = new Field("id", PDO::PARAM_INT);
        $this->title = new Field("title");
        $this->content = new Field("content");
        $this->created_at = new Field("created_at", PDO::PARAM_INT);
        $this->updated_at = new Field("updated_at", PDO::PARAM_INT);
        $this->usr_id = new Field("usr_id", PDO::PARAM_INT);

        // Assign values
        $this->id->setValue(get($values["id"]));
        $this->title->setValue(get($values["title"]));
        $this->content->setValue(get($values["content"]));
        $this->created_at->setValue(get($values["created_at"]));
        $this->updated_at->setValue(get($values["updated_at"]));
        $this->usr_id->setValue(get($values["usr_id"]));
    }
}

function get_post($fields='*', $filter_by=[]){
    return get_row('Post', $fields, $filter_by);
}
?>