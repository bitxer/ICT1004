<section class="card border-0 m-3" id="login">
    <div class="m-auto">
        <h1>Member Login</h1>
        <form class="login" name="frmLogin" action="/login/login_process" method="POST">
            <div class="form-group">
                <label for="loginid">Login ID</label>
                <input class="form-control" type="text" required id="loginid" name="loginid" placeholder="Enter Login ID">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input class="form-control" type="password" id="password" required name="password" placeholder="Enter password">
                <br>
                <div class="form-group m-auto">
                    <input type="hidden" name="<?=FORM_CSRF_FIELD?>" value="<?= $_SESSION[SESSION_CSRF_TOKEN]; ?>">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </form>
        <?php
            if (isset($_GET['error'])){
                if($_GET['error'] == "invalidcredentials"){
                    echo '<p id="loginerror">Invalid username/password combination.</p>';
                } else if($_GET['error'] == "accountlocked"){
                    echo '<p id="loginerror">Your account is suspended.</p>';
                }
            }
        ?>
    </div>
</section>
