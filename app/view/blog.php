<section>
<?php if (isset($_SESSION['post_success'])): ?>
    <article class="alert alert-success alert-dismissible fade show mt-2 mb-0 alert-box post-alert" role="alert">
        <h5 class="text-center">Your Post has been added!!</h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </article>
    <?php unset($_SESSION['post_success']);
endif; ?>
<?php if (isset($_SESSION['update_success'])): ?>
    <article class="alert alert-success alert-dismissible fade show mt-2 mb-0 alert-box post-alert" role="alert">
        <h5 class="text-center">Your Post has been updated!!</h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </article>
    <?php unset($_SESSION['update_success']);
endif; ?>
 <h2 class="card border-0 border-bottom pt-3 mb-3 text-center">Welcome to <?= $data['blog_name'] ?>'s blog!</h2>
    <article class="card m-1">
        <?php if (isset($data['blog_info'])) : ?>
                <div class="card-header d-sm-flex">
                    <h2 class="mr-auto  pt-2 pl-5">Blog Post</h2>
                    <?php include 'blog.nav.inc.php' ?>
                </div>
            <?php if (isset($data['blog_info']))  : ?>
                <?php foreach ($data['blog_info'] as &$entry) : ?>
                    <article class="card m-5">
                            <header class="card-header">
                                <?php
                                $epoch = (int)($entry->getField('created_at')->getValue());
                                $PostTimeStamp = new DateTime("@$epoch");
                                ?>
                                <?= $PostTimeStamp->format('D, j M Y g:i:s A'); ?>
                            </header>
                            <div class="card-body">
                                <h5 class="card-title"><?= $entry->getField('title')->getValue() ?></h5>
                                <p class="card-text post-preview">
                                    <?php
                                    $preview_content = $entry->getField('content')->getValue();
                                    if (strlen($preview_content) > 100) {
                                        $preview_content = substr($preview_content, 0, 100) . '...';
                                    }
                                    ?>
                                    <?= $preview_content ?>
                                </p>
                                <a href="<?= $_SERVER['REQUEST_URI'] . '/' . $entry->getField('id')->getValue() ?>"
                                   class="btn btn-primary">Read More</a>
                            </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
            <footer class="card-footer text-muted">
                <?php if (isset($data['blog_info'])) : ?>
                    <?php include 'blog.nav.inc.php' ?>
                <?php endif; ?>
            </footer>
        <?php else : ?>
                    <?php if (isset($data['blog_max_page'])) : ?>
                        <div class="card-body">
                            <h5 class="card-title">Max Page Reached (&gt;.&lt;)</h5>
                            <p class="card-text">Yep, Page out of Range kinda</p>
                            <a href="<?= parse_url($_SERVER["REQUEST_URI"])["path"] ?>" class="btn btn-primary">Return
                                to Blog</a>
                        </div>
                    <?php else: ?>
                        <h2 class="card-header">Hmmm...</h2>
                        <div class="card-body">
                            <h5 class="card-title">No Post Yet!</h5>
                            <p class="card-text">Blog under construction</p>
                        </div>
                    <?php endif; ?>
        <?php endif; ?>
    </article>
    <article class="card mt-5 mb-5 ml-1 mr-1 h-25">
        <h5 class="card-header text-center">Blog Stats</h5>
        <div class="card-body">
                <p class="text-center"><span class="font-weight-bold"><?=$data['total_post']?></span> Post</p>
                <p class="text-center"><span class="font-weight-bold"><?=$data['total_likes']?></span> Likes</p>
        </div>
    </article>
</section>