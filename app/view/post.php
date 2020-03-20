<section>
    <?php $entry = $data['post_info'][0]; ?>
        <article>
            <div class="card m-5">
                <header class="card-header">
                    <div class="row">
                        <?php
                        $epochCreated = (int)($entry->getField('created_at')->getValue());
                        $epochUpdated = (int)($entry->getField('updated_at')->getValue());

                        $dtCreated = new DateTime("@$epochCreated");
                        $dtUpdated = new DateTime("@$epochUpdated");
                        echo "<span class='col-md'><p>" . $dtCreated->format('D, j M Y g:i:s A') . "</p></span>";
                        if ($epochUpdated > $epochCreated) {
                            echo "<span class='col-md'><p class='text-right'>Last Edited: " . $dtUpdated->format('D, j M Y g:i:s A') . "</p></span>";
                        } ?>
                    </div>
                    <div class="row">
                        <span class="col text-right pr-1"><?= $data["likes_count"] ?></span>
                        <span class="col text-left pl-0">Likes</span>
                    </div>
                </header>
                <main class="card-body">
                    <h5 class="card-title"><?= $entry->getField('title')->getValue() ?></h5>
                    <p class="card-text blog-post">
                        <?php $content = $entry->getField('content')->getValue(); ?>
                        <?= $content ?>
                    </p>
                </main>
                <footer class="card-footer text-muted">
                    <div class="d-flex">
                        <span class="mr-auto p-2">
                        <a class="btn btn-primary" href="/blog/u/<?= $data['blog_name'] ?>">Back to Blog</a>
                        </span>
                        <?php if($_SESSION['loginid']):?>
                        <span class="p-2">
                            <form action="/blog/like" method="post">
                                <input type="hidden" name="postid" value="<?= $entry->getField('id')->getValue() ?>">
                                <?php
                                $like_css = "primary";
                                $like_action = "Like";
                                if (is_null($data['usr_like'])) {
                                    $like_css = "primary";
                                    $like_action = "Like";
                                } else {
                                    $like_css = "danger";
                                    $like_action = "Unlike";
                                } ?>
                                    <input class="btn btn-<?= $like_css ?>" type="submit" name="submit"
                                           value="<?= $like_action ?>">
                            </form>
                        </span>
                            <?php endif;?>
                        <span class="p-2">
                            <?php //Get Full url
                            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>
                            <button class="btn btn-primary" id="share-btn"
                                    data-clipboard-text="<?= $link ?>">Share</button>
                        </span>

                        <?php if ($data['blog_name'] == $_SESSION['loginid'])  : ?>
                            <span class="p-2">
                            <a class="btn btn-primary d-flex justify-content-end"
                               href="/blog/updatepost/<?= $entry->getField("id")->getValue() ?>">Update Post</a>
                        </span>
                        <?php endif; ?>
                    </div>
                </footer>
        </article>
        <article>
            <section class="card m-5">
                <header class="card-header text-center">
                    <div class="row">
                        <span class="col text-right pr-1"><?= sizeof($data['comments']) ?></span>
                        <span class="col text-left pl-0">Comment(s)</span>
                    </div>
                </header>
                <?php
                    if(isset($_SESSION["loginid"])) :?>
                <div class="card-body">
                <?php
                        if (is_bool($data['comment_success'])) :
                            if ($data['comment_success']):?>
                                <span class="alert alert-success alert-dismissible fade show mt-2 mb-0 alert-box w-25"
                                    role="alert">
                                <p class="text-center">Your Comment has been added!!</p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </span>
                            <?php else: ?>
                                <span class="alert alert-danger alert-dismissible fade show mt-2 mb-0 alert-box w-25"
                                    role="alert">
                                    <p class="text-center">Please enter a comment.</p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </span>
                            <?php endif;
                        endif; ?>

                    
                    <form class="form-group" action="<?= (parse_url($_SERVER['REQUEST_URI']))['path'] ?>" method="post">
                        <div class="pb-2 pl-5">
                            <label class="form-group"><?= $_SESSION['loginid'] ?></label>
                        </div>
                        <div class="row pb-2 pl-5 pr-2">
                                <span class="input-group">
                                    <textarea class="form-control comment-box" rows="5" aria-label="With textarea"
                                              name="comment" required></textarea>
                                </span>
                        </div>
                        <div class="row pb-2 pl-5">
                                <span class="input-group">
                                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                                    <input class="btn btn-primary" type="submit" name="submit">
                                </span>
                        </div>
                    </form>
                    <span class="border-top"></span>
                </div>
                <?php endif;?>
                <?php if (!empty($data['comments'])) : ?>
                    <?php foreach ($data['comments'] as &$comment) : ?>
                        <?php
                        $epoch = (int)($comment['created_at']);
                        $commentTimeStamp = new DateTime("@$epoch");
                        ?>
                        <span class="border-top"></span>
                        <div class="card-body pb-2 pl-5 pr-2">
                            <p><span><a class="nav-link"
                                        href="/blog/u/<?= $comment['loginid'] ?>"><?= $comment['loginid'] ?></a></span>
                            </p>
                            <p class="card-text"><?= $comment['comment'] ?></p>
                            <p class="card-text"><?= $commentTimeStamp->format('D, j M Y g:i:s A'); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="card-body pb-2 pl-5 pr-2">
                        <p class="card-text text-center">No Comments Yet. Be the first to Comment!!</p>
                    </div>
                    <span class="pt-5"></span>
                <?php endif; ?>
            </section>
        </article>
</section>
