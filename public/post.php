 <?php if(isset($data['post_info'][0]))  : ?>
    <?php  $entry = $data['post_info'][0]; ?>
        <section>
            <article>
                <div class="card m-5">
                    <div class="card-header">
                        <?php
                        $epoch = (int)($entry->getField('created_at')->getValue());
                        $dt = new DateTime("@$epoch");
                        ?>
                        <?=$dt->format('D, j M Y g:i:s A');?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?=$entry->getField('title')->getValue() ?></h5>
                        <p class="card-text">
                            <?php $content = $entry->getField('content')->getValue(); ?>
                            <?=$content?>
                        </p>
                    </div>
                    <div class="card-footer text-muted">
                        <a class="btn btn-primary" href="/blog/u/<?=$data['blog_name']?>">Back to Blog</a>
                    </div>
            </article>
            <article>
                <section class="card m-5">
                    <header class="card-header text-center">
                        Comments
                    </header>
                    <main class="card-body">
                        <form class="form-group" action="<?=(parse_url($_SERVER['REQUEST_URI']))['path']?>" method="post">
                            <div class="row pb-2 pl-5">
                                <span class="col-2">
                                    ProfilePic
                                </span>
                                <span class="col">
                                    <label class="form-group">Username</label>
                                </span>
                            </div>
                            <div class="row pb-2 pl-5 pr-2">
                                <span class="input-group">
                                    <textarea class="form-control comment-box" rows="5" aria-label="With textarea"></textarea>
                                </span>
                            </div>
                            <div class="row pb-2 pl-5">
                                <span class="input-group">
                                    <input class="btn btn-primary" type="submit" name="submit">
                                </span>
                            </div>
                        </form>
                    </main>
                    <span class="border-top"></span>
                    <div class="card-body pb-2 pl-5 pr-2">
                        <p><span>User Profile</span>Username</p>
                        <p class="card-text">Comments oencwcw</p>
                    </div>
                </section>
            </article>
        </section>
    <?php else: ?>
        <section>
            <article>
                <div class="card">
                    <h5 class="card-header">Hmmm...</h5>
                    <div class="card-body">
                        <h5 class="card-title">Post Not Found</h5>
                    </div>
                </div>
            </article>
        </section>
    <?php endif;?>