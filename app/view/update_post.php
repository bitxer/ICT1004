<section>
<?php if ($_GET) :
    if (isset($_GET['update'])) :
        if ($_GET['update'] == 'failed'):?>
            <article class="alert alert-danger alert-dismissible fade show alert-box ml-5 w-25" role="alert">
                <p class="text-center">Your Post is empty</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </article>
        <?php
        endif;
    endif;
endif; ?>

    <article class="m-5">
        <form action="/blog/updatepost/<?= ($data['blog_post'])->getField('id')->getValue(); ?>" method="post">
            <legend class="form-group">Edit Post</legend>
            <fieldset class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="title">
                            <h2>Title: <?= ($data['blog_post'])->getField('title')->getValue(); ?></h2>
                        </label>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control post-box" name="content" rows="18"
                                placeholder="Edit your Post here..."
                                required><?= ($data['blog_post'])->getField('content')->getValue(); ?></textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="postid" value="<?= ($data['blog_post'])->getField('id')->getValue(); ?>">
                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                        <button class="btn btn-primary" id="submit">Submit new post</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </article>
</section