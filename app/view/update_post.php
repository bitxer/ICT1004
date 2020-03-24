<section class="m-5">
<?php if ($_GET) :
    if (isset($_GET['update'])) :
        if ($_GET['update'] == 'failed'):?>
            <article class="alert alert-danger alert-dismissible fade show alert-box mt-2 mb-0 post-alert" role="alert">
                <p class="text-center">Your Post is empty</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </article>
        <?php
        endif;
    endif;
endif; ?>
    <h2>Edit Post</h2>
        <form action="/blog/updatepost/<?= ($data['blog_post'])->getField('id')->getValue(); ?>" method="post">
            <fieldset class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="h4">
                            Title: <?= ($data['blog_post'])->getField('title')->getValue(); ?>
                        </label>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control post-box" name="content" rows="18"
                                placeholder="Edit your Post here..."
                                required><?= ($data['blog_post'])->getField('content')->getValue(); ?></textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="postid" value="<?= ($data['blog_post'])->getField('id')->getValue(); ?>">
                        <input type="hidden" name="<?=FORM_CSRF_FIELD?>" value="<?= $_SESSION[SESSION_CSRF_TOKEN] ?>">
                        <button class="btn btn-primary" id="submit">Update post</button>
                    </div>
                </div>
            </fieldset>
        </form>
</section>