    <div class="card" id="login">
        <h1>Member Login</h1>
        <form class="login"name="frmLogin" action="/login/login_process" method="post">
            <div class="form-group">
                <label for="loginid">Login ID</label>
                <input class="form-control" type="text" required id="loginid" name="loginid" value="<?php if (isset($_POST['loginid'])); ?>" placeholder="Enter Login ID">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input class="form-control" type="password" id="password" required name="password" value="<?php if (isset($_POST['password'])); ?>" placeholder="Enter password">
                <br>
                <div class="form-group">
                    <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
                <?php
                    if (isset($_GET['error'])){
                        if($_GET['error'] == "invalidcredentials"){
                            echo '<p id="loginerror">Invalid username/password combination.</p>';
                        } else if($_GET['error'] == "accountlocked"){
                            echo '<p id="loginerror">Your account is suspended.</p>';
                        }
                    }
                ?>
        </form>
    </div>