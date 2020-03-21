<?php

require_once('../app/controllers/BlogController.php');
require_once('../app/controllers/LikesController.php');


class blog extends Router
{
    protected $RIGHTS = 0;

    /**
     * Route for /blog
     */


    /**
     * /blog/
     *
     * No access to all users
     */
    public function index()
    {
        $this->abort(404);
    }

    /**
     * /blog/u
     *
     * No access to all users
     *
     * /blog/u/<loginid>
     *
     * <loginid>'s blog page
     *
     * /blog/u/<loginid>/<postid>
     *
     * Single Post by <loginid>
     *
     * @param array argv argv[0]: set as loginid
     *                   argv[1]: set as postid
     *
     * array of argv containing more than 2 values
     * will return Error 404
     *
     * Invalid loginid returns Error 404
     */

    public function u($argv)
    {
        $blog_control = new BlogController();
        $like_control = new LikesController();
        //Checks if parameters contains at least 1 and at most 2 parameters
        if ((sizeof($argv)) < 1 || (sizeof($argv) > 2)) {
            //loginid not in route or parameters > 2
            $this->abort(404);
        } else {
            //loginid in route
            $loginid = $argv[0];
            $UserBlogID = $blog_control->getUserID($loginid);
            //Checks if the user exist
            if ($UserBlogID == null) {
                //User does not exist
                $this->abort(404);
            } else {
                //User Exist

                //Check if request for a blog post or view blog
                if (isset($argv[1])) {
                    //Go to Blog Post

                    //Check if post exist
                    $post_info = $blog_control->getPost($UserBlogID, $PostID = $argv[1]);
                    if ($post_info == null) {
                        //Post not found
                        $this->abort(404);
                    } else {
                        //Post is found
                        require_once '../app/model/Post.php';
                        $isComAdded = "";
                        //Check if a comment is being added
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            //returns true:Comment added, false:Comment not added
                            $isComAdded = $blog_control->addComments($PostID = $argv[1]);
                        }
                        //Get info of Logged in user
                        $usr_like = null;
                        if(isset($_SESSION[SESSION_LOGIN])){
                            $usr_id = $blog_control->getUserID($_SESSION[SESSION_LOGIN]);
                            $usr_like = $like_control->getLikes(3, $usr_id, $postid = $argv[1]);
                        }

                        //Get info of the blog post
                        $post_like = $like_control->getLikes(2, null, $postid = $argv[1]);
                        $comments = $blog_control->getComments(($post_info[0])->getField('id')->getValue());

                        //Set page data
                        $data = [
                            'page' => 'post',
                            'post_info' => $post_info,
                            'usr_like' => $usr_like,
                            'likes_count' => $post_like,
                            'blog_name' => $loginid,
                            'comments' => $comments,
                            'comment_success' => $isComAdded,
                            'script' => '/static/js/clipboard.js'
                        ];

                        //Serve /blog/u/<loginid>/<postid> with post.php
                        $this->view($data);
                    }
                } else {
                    //View Blog

                    //Get User Blog info
                    $blog_info = $blog_control->getBlog($UserBlogID);
                    $blog_by_page = $blog_control->getBlogbyPageX($blog_info);
                    $blog_like = $like_control->getLikes(1, $UserBlogID);

                    //Check if blog has a post
                    if ($blog_by_page == null) {
                        //This user has no post
                        //Set blog info
                        $data = [
                            'page' => 'blog',
                            'blog_name' => $loginid,
                            'total_post' => 0,
                            'total_likes' => 0
                        ];
                        //Serve /blog/u/<loginid> with blog.php
                        $this->view($data);

                        //Check if the blog nav has more than 1 page
                    } elseif (!isset($blog_by_page['row'])) {
                        //Blog nav has 1 page
                        //Set blog info
                        $data = [
                            'page' => 'blog',
                            'blog_name' => $loginid,
                            'blog_max_page' => $blog_by_page['max_page'],
                            'total_post' => is_null($blog_info) ? 0 : sizeof($blog_info),
                            'total_likes' => $blog_like
                        ];
                        //Serve /blog/u/<loginid> with blog.php
                        $this->view($data);
                    } else {
                        //Blog has more than 1 page
                        $data = [
                            'page' => 'blog',
                            'blog_info' => $blog_by_page['row'],
                            'blog_current_page' => $blog_by_page['cur_page'],//goes to page x of blog nav
                            'blog_max_page' => $blog_by_page['max_page'],
                            'blog_name' => $loginid,
                            'total_post' => is_null($blog_info) ? 0 : sizeof($blog_info),
                            'total_likes' => $blog_like
                        ];
                        //Serve /blog/u/<loginid>?page=<int> with blog.php
                        $this->view($data);
                    }
                }
            }
        }
    }
    /**
     * /blog/create
     * Creates a post for <loginid>
     */
    public function create()
    {
        $blog_control = new BlogController();
        //Checks if a post is being added
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //A post is being added

            //return  either array: an post entry is invalid, or bool: post entry is added
            $postsuccess = $blog_control->AddPost($_POST);
            //Check if post is added
            if (is_bool($postsuccess)) {
                //Post is added
                $_SESSION['post_success'] = true;
                //redirect to /blog/u/<loginid>
                header("Location: /blog/u/" . $_SESSION[SESSION_LOGIN]);
            } else {
                //Post is not added

                //returns to create post page with an error message
                $this->view(['page' => 'create', 'err_msg' => $postsuccess]);
            }
        } else {
            //User is creating a post
            $this->view(['page' => 'create']);
        }
    }
    /**
     * /blog/updatepost/<postid>
     * 
     * Update an existing post
     * 
     * @param array argv Contains the postid
     * 
     * Returns an error page if an invalid post is being edited
     */
    public function updatepost($argv)
    {
        //Check is postid is set
        if (sizeof($argv)!=1) {
            //postid is not set
            $this->abort(404);
        } else {
            //postid is set
            $postid = $argv[0];
            //check if postid is an integer
            if (!is_int(filter_var($postid, FILTER_VALIDATE_INT))) {
                //postid is not a valid int
                $this->abort(403);
            } else {
                //postid is an int
                $blog_control = new BlogController();

                //Check if an update request is sent
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    //Post is being updated
                    //returns either array: entry is invalid, bool: update is a success
                    $postsuccess = $blog_control->updatePost($_POST['content'], $postid);
                    if ($postsuccess == true) {
                        //update is a success
                        //Redirect to user blog
                        $_SESSION['update_success'] = true;
                        header("Location: /blog/u/" . $_SESSION[SESSION_LOGIN]);
                    } else {
                        //update fails
                        //Sends user back to /blog/updatepost/<postid>
                        header("Location: /blog/updatepost/" . $postid . "?update=failed");
                    }
                } else {
                    //User want to edit <postid>
                    $usr_id = $blog_control->getUserID($_SESSION[SESSION_LOGIN]);
                    $blog_post = $blog_control->getPost($usr_id, $postid);
                    //Check if the user owns that post
                    if (is_null($blog_post)) {
                        //User has no access to that post
                        $this->abort(403);
                    } else {
                        //User can edit post
                        $this->view(['page' => 'update_post', 'blog_post' => $blog_post[0]]);
                    }
                }
            }
        }
    }
    /**
     * /blog/like
     * 
     * Send a like/Unlike to <postid>
     * 
     * Only accepts POST request
     */
    public function like()
    {
        //Only accepts post request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->abort(405);
        }
        $likes_control = new LikesController();

        if (isset($_POST['submit'])) {
            if ($_POST['submit']) {
                $postid = $_POST['postid'];
                //Checks if the postid is an int
                if (is_int(filter_var($postid, FILTER_VALIDATE_INT))) {
                    //Checks if user like the post
                    if ($_POST['submit'] == 'Like') {
                        $likes_control->setLikes($postid);
                        header('Location: ' . parse_url($_SERVER['HTTP_REFERER'])['path']);
                        //check if user unlike the post
                    } elseif ($_POST['submit'] == 'Unlike') {
                        $likes_control->RemoveLikes($postid);
                        header('Location: ' . parse_url($_SERVER['HTTP_REFERER'])['path']);
                    }
                } else {
                    $this->abort(405);
                }
            } else {
                $this->abort(404);
            }
        } else {
            $this->abort(404);
        }
    }
}