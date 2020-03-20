<section>
<?php if (isset($_SESSION['post_success'])): ?>
    <article class="alert alert-success alert-dismissible fade show ml-5 mt-2 mb-0 alert-box" role="alert">
        <p class="text-center">Your Post is has been added!!</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </article>
    <?php unset($_SESSION['post_success']);
endif; ?>
    <article class="card border-0">
        <div class="border-bottom pt-3 mb-3">
            <header class="card-body">
                <h2 class="text-center">Welcome to <?= $data['blog_name'] ?>'s blog!</h2>
            </header>
        </div>
    </article>
    <article class="card m-1">
        <?php if (isset($data['blog_info'])) : ?>
            <header class="card-header">
                <section class="d-flex">
                    <span class="mr-auto  pt-2 pl-5"><p class="h2">Blog Post</p></span>
                    <span class="p-2"><?php include 'blog.nav.inc.php' ?></span>
                </section>
            </header>
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
                            <main class="card-body">
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
                            </main>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
            <footer class="card-footer text-muted">
                <?php if (isset($data['blog_info'])) : ?>
                    <?php include 'blog.nav.inc.php' ?>
                <?php endif; ?>
            </footer>
        <?php else : ?>
            <article class="card">
                    <?php if (isset($data['blog_max_page'])) : ?>
                        <div class="card-body">
                            <h5 class="card-title">Max Page Reached (>.<)</h5>
                            <p class="card-text">Yep, Page our of Range kinda</p>
                            <a href="<?= parse_url($_SERVER["REQUEST_URI"])["path"] ?>" class="btn btn-primary">Return
                                to Blog</a>
                        </div>
                    <?php else: ?>
                        <header class="card-header">Hmmm...</header>
                        <div class="card-body">
                            <h5 class="card-title">No Post Yet!</h5>
                            <p class="card-text">Blog under construction</p>
                        </div>
                    <?php endif; ?>
            </article>
        <?php endif; ?>
    </article>
    <article class="card mt-5 mb-5 ml-1 mr-1 h-25">
        <header class="card-header">
            <p class="text-center h5 ">Blog Stats</p>
        </header>
        <div class="card-body">
                <span class="row">
                    <p class="col-md text-center"><span class="font-weight-bold"><?=$data['total_post']?></span> Post</p>
                </span>
                <span>
                <p class="col-md text-center"><span class="font-weight-bold"><?=$data['total_likes']?></span> Likes</p>
                </span>
        </div>
    </article>
</section>