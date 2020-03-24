<section class=" main-background intro-blog">

<?php if ($_GET['timeout']):?>
    <article class="card border-0 intro-head p-5">
        <div class="alert alert-danger alert-dismissible fade show mt-2 mb-0 alert-box comment-alert" role="alert">
            <h5 class="text-center">Your Session has timeout!! Please sign in again</h5>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </article>
<?php endif; ?>
    <h2 class="intro-head m-0 p-5 text-center">Welcome to Budget Blogspot</h2>
    <div class="row m-0 intro-blog">
        <article class="col">
            <div class="text-center">
                <h2 class="font-italic">Create Blogs</h2>
                <h2 class="font-italic">Find Blogs</h2>
                <h2 class="font-italic">Join the conversation</h2>
                <h2 class="font-italic h1 m-5">Join Budget Blogspot Today</h2>
            </div>
        </article>
        <article class="col">
            <div class="text-center">
                <h3>Got an Account? <a class="btn btn-success" href="/login">Log in</a> Now!!</h3>
                <h3>No Account? No problem, <a class="btn btn-success" href="/register">Sign Up</a> Today</h3>
            </div>
        </article>
    </div>
</section>