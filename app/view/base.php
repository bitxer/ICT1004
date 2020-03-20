<!DOCtype html>
<html lang="en">
    <head>
        <title>Blog</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity=
            "sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
            crossorigin="anonymous">
        <link rel="stylesheet" href="/static/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--jQuery-->
        <script defer
                src="https://code.jquery.com/jquery-3.4.1.min.js"
                integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
                crossorigin="anonymous">
        </script>
        <!--Bootstrap JS-->
        <script defer
                src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
                integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm"
                crossorigin="anonymous">
        </script>
        <!--Clipboard JS-->
        <script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
        <!--Icons-->
        <link rel="stylesheet"
            href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
            integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
            crossorigin="anonymous">
        <!--Custom JS -->
        <?php 
        if (isset($data['script'])) {
            $script = $data['script'];
            echo "<script defer src=\"$script\"></script>";
        }
        ?>
        <script defer
                src="/static/js/clipboard.js">
        </script>
    </head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <a class="navbar-brand" href="/">Logo</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collpase navbar-collapse mr-auto" id="navbarMenu">
                <?php if(isset($_SESSION['loginid'])):?>
                <ul class="navbar-nav mr-auto">
                    <div class="search-containter">
                        <form class="searchbar d-flex" action="#" style="margin:auto;max-width:260px">
                            <input type="text" placeholder="Search" name="search">
                            <button type="submit"><i class="fa fa-search"> Search</i></button>
                        </form>
                    </div>
                </ul>
                <?php else : ?>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/check/aboutus">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/check/contactus">Contact Us</a>
                    </li>
                </ul>
                <?php endif;?>

                <?php if(isset($_SESSION['loginid'])) :?>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/blog/u/<?= $_SESSION['loginid'] ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog/create">Create</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Account Settings
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" >
                            <a class="dropdown-item" href="/account/profile"><i class="fas fa-cogs pr-3"></i>Profile</a>
                            <span class="dropdown-divider"></span>
                            <a class="dropdown-item" href="/signout"><i class="fas fa-sign-out-alt pr-3"></i>Sign Out</a>
                        </div>
                    </li>
                </ul>
                <?php else: ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Sign Up</a>
                        </li>
                    </ul>
                <?php endif?>
            </div>
        </nav>
        <main class="container">
            <?php
            include '../app/view/' . $data['page'] . '.php';
            ?>
        </main>
        <footer class="container border-top">
            <p class="text-center">Copyright &copy; 2020 Budget Blogspots</p>
        </footer>
    </body>
</html>