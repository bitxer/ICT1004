        <h1>Member Login</h1>
        <p>
            For existing members, please go to the <a href="#">Sign In page</a>
        </p>
        <form name="frmLogin" action="/login/login_process" method="post">
            <div class="form-group">
                <label for="loginid">Login ID</label>
                <input class="form-control" type="text" required id="loginid" name="loginid" value="<?php if (isset($_POST['loginid']));?>" placeholder="Enter Login ID">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input class="form-control" type="password" id="password" required name="password" value="<?php if (isset($_POST['password'])); ?>" placeholder="Enter password">
                <div class="form-group">
                    <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
                <?php
                    if (isset($_GET['error'])){
                        if($_GET['error'] == "invalidcredentials"){
                            echo '<p id="loginerror">Invalid username/password combination.</p>';
                        }
                    }
                ?>
        </form>