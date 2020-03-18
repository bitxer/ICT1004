<?php
require_once("../app/model/utils/Field.php");
require_once("../app/model/utils/Model.php");
require_once("../app/utils/helpers.php");

class Post_Like extends Model{
    const tablename = "post_likes";
    const fields = ["id", "usr_id", "posts_id", "liked_at"];
    protected $id = null;
    protected $usr_id = null;
    protected $posts_id = null;
    protected $liked_at = null;

    function __construct($values)
    {
        // Initialise fields
        $this->id = new Field("id", PDO::PARAM_INT);
        $this->usr_id = new Field("usr_id", PDO::PARAM_INT);
        $this->posts_id = new Field("posts_id", PDO::PARAM_INT);
        $this->liked_at = new Field("liked_at", PDO::PARAM_INT);

        // Assign values
        $this->id->setValue(get($values["id"]));
        $this->usr_id->setValue(get($values["usr_id"]));
        $this->posts_id->setValue(get($values["posts_id"]));
        $this->liked_at->setValue(get($values["liked_at"]));
    }
}

function get_post_likes($fields='*', $filter_by=[]){
    return get_row('Post_Like', $fields, $filter_by);
}
?>