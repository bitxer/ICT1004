<?php
require_once("../app/model/Field.php");
require_once("../app/model/Model.php");
require_once("../app/utils/helpers.php");

class Comment extends Model{
    const tablename = "comments";
    const fields = ["comment", "usr_id", "posts_id", "created_at"];
    protected $id = null;
    protected $comment = null;
    protected $usr_id = null;
    protected $posts_id = null;
    protected $created_at = null;

    function __construct($values)
    {   
        // Initialise fields
        $this->id = new Field("id", PDO::PARAM_INT);
        $this->comment = new Field("comment");
        $this->usr_id = new Field("usr_id", PDO::PARAM_INT);
        $this->posts_id = new Field("posts_id", PDO::PARAM_INT);
        $this->created_at = new Field("created_at", PDO::PARAM_INT);

        // Assign values
        $this->id->setValue(get($values["id"]));
        $this->comment->setValue(get($values["comment"]));
        $this->usr_id->setValue(get($values["usr_id"]));
        $this->posts_id->setValue(get($values["posts_id"]));
        $this->created_at->setValue(get($values["created_at"]));
    }
}

function get_comment($fields='*', $filter_by=[]){
    return get_row(Comment::tablename, $fields, $filter_by);
}
?>