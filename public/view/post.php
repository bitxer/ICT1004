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
                        <p class="card-text blog-post">
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
                                <span class="col-1">
                                    ProfilePic
                                </span>
                                <span class="col">
                                    <label class="form-group"><?=$_SESSION['loginid']?></label>
                                </span>
                            </div>
                            <div class="row pb-2 pl-5 pr-2">
                                <span class="input-group">
                                    <textarea class="form-control comment-box" rows="5" aria-label="With textarea" name="comment" required></textarea>
                                </span>
                            </div>
                            <div class="row pb-2 pl-5">
                                <span class="input-group">
                                    <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
                                    <input class="btn btn-primary" type="submit" name="submit">
                                </span>
                            </div>
                        </form>
                    </main>
                    <?php if(!empty($data['comments'])) : ?>
                        <?php foreach($data['comments'] as &$comment) :?>
                        <span class="border-top"></span>
                            <?php
                            $epoch = (int)($comment['created_at']);
                            $commentTimeStamp = new DateTime("@$epoch");
                            ?>
                        <main class="card-body pb-2 pl-5 pr-2">
                            <p><span><a class="nav-link" href="/blog/u/<?=$comment['loginid']?>"><?=$comment['loginid']?></a></span></p>
                            <p class="card-text"><?=$comment['comment']?></p>
                            <p class="card-text"><?=$commentTimeStamp->format('D, j M Y g:i:s A');?></p>
                        </main>
                        <?php endforeach; ?>
                    <?php else: ?>
                         <span class="border-top pt-5"></span>
                         <main class="card-body pb-2 pl-5 pr-2">
                             <p class="card-text text-center">No Comments Yet. Be the first to Comment!!</p>
                         </main>
                        <span class="pt-5"></span>
                    <?php endif;?>
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