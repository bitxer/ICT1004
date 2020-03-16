<section class="m-5">
    <form action="/blog/updatepost" method="post">
        <legend class="form-group">Edit Post</legend>
        <fieldset class="row">
            <div class="col">
                <div class="form-group">
                    <label for="title">
                        <h2>Title: <?=($data['blog_post'])->getField('title')->getValue();?></h2>
                    </label>
                </div>
                <div class="form-group">
                    <textarea class="form-control post-box" name="content" rows="18" placeholder="Add your Post here..."><?=($data['blog_post'])->getField('content')->getValue();?></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" name="postid" value="<?=($data['blog_post'])->getField('id')->getValue();?>">
                    <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
                    <button class="btn btn-primary" id="submit">Submit new post</button>
                </div>
            </div>
        </fieldset>
    </form>
</section>
