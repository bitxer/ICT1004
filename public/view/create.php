<?php if(isset($data['err_msg'])):?>
<section class="alert alert-danger alert-dismissible fade show alert-box ml-5 w-25" role="alert">

    <?php if(($data['err_msg'])[0]) : ?>
    <p class="text-center">Title is empty</p>
    <?php endif;
    if(($data['err_msg'])[1]) :?>
    <p class="text-center">Your Post is empty</p>
    <?php endif;?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</section>

<?php endif;?>

<section class="ml-5 mr-5 mt-3">
        <form action="/blog/create" method="post">
            <legend class="form-group">Submit new post</legend>
            <fieldset class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Title" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control post-box" name="content" rows="18" placeholder="Add a Post here..." required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
                        <button class="btn btn-primary" id="post-submit">Submit new post</button>
                    </div>
                </div>
            </fieldset>
        </form>
 </section>
