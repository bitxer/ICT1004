 <section class="m-5">
        <form action="/blog/create" method="post">
            <legend class="form-group">Submit new post</legend>
            <fieldset class="row">
                <div class="col">
                    <fieldset class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Title">
                    </fieldset>
                    <fieldset class="form-group">
                        <textarea class="form-control post-box" name="content" rows="18" placeholder="Add a Post here..."></textarea>
                    </fieldset>
                    <fieldset class="form-group">
                        <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
                        <button class="btn btn-primary" id="submit">Submit new post</button>
                    </fieldset>
                </div>
            </fieldset>
        </form>
 </section>
