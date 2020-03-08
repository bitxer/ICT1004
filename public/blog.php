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
            <article>
                <div class="card border-light mb-3">
                    <div class="card-body">
                        <h2>Welcome to <?=$data['blog_name']?>'s blog!</h2>
                    </div>
                </div>
            </article>
        </section>
        <section>
            <?php if(isset($data['blog_info']))  : ?>
                <?php foreach ($data['blog_info'] as &$entry) : ?>
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
                                    <?php
                                    $preview_content = $entry->getContent();
                                    if(strlen($preview_content)>100){
                                        $preview_content = substr($preview_content,0,100) . '...';
                                    }
                                        ?>
                                    <?=$preview_content?>
                                </p>
                                <a href="<?=$_SERVER['REQUEST_URI'] . '/' . $entry->getID() ?>" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
            <article>
                <div class="card">
                    <h5 class="card-header">Hmmm...</h5>
                    <div class="card-body">
                        <h5 class="card-title">No Post Yet!!</h5>
                        <p class="card-text">Blog under construction</p>
                    </div>
                </div>
            </article>
            <?php endif;?>
        </section>
    </body>
</html>