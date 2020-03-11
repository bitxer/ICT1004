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
    <body class="container-fluid">
        <section>
            <article>
                <div class="card border-light mb-3">
                    <main class="card-body">
                        <h2>Welcome to <?=$data['blog_name']?>'s blog!</h2>
                    </main>
                </div>
            </article>
        </section>
        <section class="card m-5">
            <?php if(isset($data['blog_info'])) : ?>
                <header class="card-header">
                    <?php include 'blog.nav.inc.php'?>
                </header>
                <?php if(isset($data['blog_info']))  : ?>
                    <?php foreach ($data['blog_info'] as &$entry) : ?>
                        <article>
                            <section class="card m-5">
                                <header class="card-header">
                                    <?php
                                    $epoch = (int)($entry->getField('created_at')->getValue());
                                    $dt = new DateTime("@$epoch");
                                    ?>
                                    <?=$dt->format('D, j M Y g:i:s A');?>
                                </header>
                                <main class="card-body">
                                    <h5 class="card-title"><?=$entry->getField('title')->getValue() ?></h5>
                                    <p class="card-text">
                                        <?php
                                        $preview_content = $entry->getField('content')->getValue();
                                        if(strlen($preview_content)>100){
                                            $preview_content = substr($preview_content,0,100) . '...';
                                        }
                                            ?>
                                        <?=$preview_content?>
                                    </p>
                                    <a href="<?=$_SERVER['REQUEST_URI'] . '/' . $entry->getField('id')->getValue() ?>" class="btn btn-primary">Read More</a>
                                </main>
                            </section>
                        </article>
                    <?php endforeach; ?>
                <?php endif;?>
                <footer class="card-footer text-muted">
                    <?php if(isset($data['blog_info'])) : ?>
                        <?php include 'blog.nav.inc.php'?>
                    <?php endif;?>
                </footer>
            <?php else :?>
                <article>
                    <div class="card">
                        <?php if(isset($data['blog_max_page'])) : ?>
                        <main class="card-body">
                            <h5 class="card-title">Max Page Reached (>.<)</h5>
                            <p class="card-text">Yep, Page our of Range kinda</p>
                                <a href="<?=parse_url($_SERVER["REQUEST_URI"])["path"]?>" class="btn btn-primary">Return to Blog</a>
                        </main>
                        <?php else:?>
                            <header class="card-header">Hmmm...</header>
                            <main class="card-body">
                                <h5 class="card-title">No Post Yet!</h5>
                                <p class="card-text">Blog under construction</p>
                            </main>
                        <?php endif;?>
                    </div>
                </article>
            <?php endif;?>
        </section>
    </body>
</html>