<html lang="en">
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
    <link rel="stylesheet" href="/static/css/style.css">
</head>
<body>
    <section class="m-5">
        <form action="/blog/create" method="post">
            <legend class="form-group">Submit new post</legend>
            <fieldset class="row">
                <div class="col">
                    <fieldset class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Title">
                    </fieldset>
                    <fieldset class="form-group">
                        <textarea class="form-control post-box" name="content" rows="20" placeholder="Add a Post here..."></textarea>
                    </fieldset>
                    <fieldset class="form-group">
                        <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
                        <button class="btn btn-primary" id="submit">Submit new post</button>
                    </fieldset>
                </div>
            </fieldset>
        </form>
    </section>
</body>
</html