<?php

require_once('../app/controllers/BlogController.php');

class blog extends Router
{
    protected $RIGHTS = 0;

    /**
     * Route for /blog
     * Available Routes:
     *  /blog/u/<loginid>           -Contains the Blog of a User
     *  /blog/u/<loginid>/<postid>  -Contains a Post od a User
     *  /blog/create                -Creates a Post
     */
    public function index()
    {
        $this->abort(404);
    }

    public function u($argv)
    {
        $blog_control = new BlogController();
        if (!isset($argv[0])) {
            $this->abort(404);
        } else {
            $loginid = $argv[0];
            if (sizeof($argv) <= 2) {
                $UserBlogID = $blog_control->getUserID($loginid);
                if ($UserBlogID == null) {
                    $this->abort(404);
                } else {
                    if (isset($argv[1])) {
                        $isComAdded = "";
                        if (!empty($_POST)) {
                            if (isset($_POST['token'])) {
                                if ($tokenmatch = (new Router())->token_compare()) {
                                    $isComAdded = $blog_control->addComments($PostID = $argv[1]);
                                } else {
                                    session_destroy();
                                    header("Location: /");
                                }
                            } else {
                                session_destroy();
                                header("Location: /");
                            }
                        }
                        $post_info = $blog_control->getPost($UserBlogID, $PostID = $argv[1]);
                        if ($post_info == null) {
                            $this->abort(404);
                        } else {
                            require_once '../app/model/Post.php';
                            $comments = $blog_control->getComments(($post_info[0])->getField('id')->getValue());
                            $data = [
                                'page' => 'post',
                                'post_info' => $post_info,
                                'blog_name' => $loginid,
                                'comments' => $comments,
                                'comment_success'=>$isComAdded];
                            $this->view($data);
                        }
                    } else {
                        $blog_info = $blog_control->getBlog($UserBlogID);
                        $blog_by_page = $blog_control->getBlogbyPageX($blog_info);
                        if ($blog_by_page == null) {
                            $this->view(['page' => 'blog', 'blog_name' => $loginid]);
                        } elseif (!isset($blog_by_page['row'])) {
                            $data = [
                                'page' => 'blog',
                                'blog_name' => $loginid,
                                'blog_max_page' => $blog_by_page['max_page']];
                            $this->view($data);
                        } else {
                            $data = [
                                'page' => 'blog',
                                'blog_info' => $blog_by_page['row'],
                                'blog_current_page' => $blog_by_page['cur_page'],
                                'blog_max_page' => $blog_by_page['max_page'],
                                'blog_name' => $loginid];
                            $this->view($data);
                        }
                    }
                }
            } else {
                $this->abort(404);
            }
        }
    }

    public function create()
    {
        $blog_control = new BlogController();
        if (isset($_SESSION['token'])) {
            if ($_POST) {
                if ($token_match = Router::token_compare()) {
                    $postsuccess = $blog_control->AddPost($_POST);//$postsuccess returns an array if an entry is invalid, bool if it is success
                    if (is_bool($postsuccess)) {
                        $_SESSION['post_success'] = true;
                        header("Location: /blog/u/" . $_SESSION['loginid']);
                    } else {
                        $this->view(['page' => 'create', 'err_msg' => $postsuccess]);
                    }
                } else {
                    session_destroy();
                    header("Location: /");
                }
            } else {
                $this->view(['page' => 'create']);
            }
        } else {
            //Go back to Login
            session_destroy();
            header("Location: /");
        }
    }

    public function updatepost()
    {
        $blog_control = new BlogController();
        if (isset($_SESSION['token'])) {
            if ($_POST) {
                if ($token_match = Router::token_compare()) {
                    $postsuccess = $blog_control->updatePost($_POST['content'], $_POST['postid']);//$postsuccess returns an array if an entry is invalid, bool if it is success
                    if ($postsuccess == true) {
                        header("Location: /blog/u/" . $_SESSION['loginid']);
                    } else {
                        $this->view(['page' => 'update_post']);
                    }
                } else {
                    session_destroy();
                    header("Location: /");
                }
            } else {
                if (is_int(filter_var($_GET['postid'], FILTER_VALIDATE_INT))) {
                    $usr_id = $blog_control->getUserID($_SESSION['loginid']);
                    $blog_post = $blog_control->getPost($usr_id, $_GET['postid']);
                    if (is_null($blog_post)) {
                        $this->abort(404);
                    } else {
                        $this->view(['page' => 'update_post', 'blog_post' => $blog_post[0]]);
                    }
                } else {
                    $this->abort(404);
                }
            }
        } else {
            //Go back to Login
            session_destroy();
            header("Location: /");
        }
    }


}