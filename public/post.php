<?php
session_start();
?>
<html>
<!--Temp head-->
<head>
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity=
          "sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">
    <script defer
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
            integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm"
            crossorigin="anonymous">
    </script>
</head>
    <body>
        <section>
            <?php if(isset($data['post_info'][0]))  : ?>
                <?php  $entry = $data['post_info'][0]; ?>
                <article>
                    <div class="card m-5">
                        <div class="card-header">
                            <?php
                            $epoch = (int)($entry->getCreated());
                            $dt = new DateTime("@$epoch");
                            ?>

                            <?=$dt->format('D, j M Y g:i:s A');?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?=$entry->getTitle() ?></h5>
                            <p class="card-text">
                                <?php $content = $entry->getContent(); ?>

                                <?=$content?>
                            </p>
                        </div>
                        <div class="card-footer text-muted">
                            <a class="btn btn-primary" href="/blog/u/<?=$data['blog_name']?>">Back to Blog</a>
                        </div>
                    </article>
                <article>
                    <div class="card m-5">
                        <div class="card-header text-center">
                            Comments
                        </div>
                        <div class="card-body">
                            <form class="form-group" action="<?=(parse_url($_SERVER['REQUEST_URI']))['path']?>" method="post">
                                <div class="row">
                                    <div class="col-2">
                                        <span>ProfilePic</span>
                                    </div>
                                    <div class="col">
                                        <label class="form-group">Username</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-group col-10">
                                        <textarea class="form-control" aria-label="With textarea"></textarea>
                                    </div>
                                <div class="col">
                                    <input class="btn btn-primary" type="submit" name="submit">
                                </div>
                                </div>
                            </form>
                        </div>


                    </div>
                </article>

            <?php else: ?>
                <article>
                    <div class="card">
                        <h5 class="card-header">Hmmm...</h5>
                        <div class="card-body">
                            <h5 class="card-title">Post Not Found</h5>
                        </div>
                    </div>
                </article>
            <?php endif;?>
        </article>
        </section>
    </body>
</html>