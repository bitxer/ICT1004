<section class="border-0 m-3">
    <h1>Admin account creation</h1>
    <p>Please create an admin account for blog administration</p>
    <form name="frmRegistration" method="POST" action="/setup">
        <div class="form-group">
            <?php
            if (!empty($errorMessage) && is_array($errorMessage)) {
            ?>
                <div class="error-message">
                    <?php
                    foreach ($errorMessage as $message) {
                        echo $message . "<br/>";
                    }
                    ?>
                </div>
            <?php
            }
            ?>
            <div class="form-group">
                <label for="loginid">Username</label>
                <div>
                    <input type="text" title="This will be your profile name." class="form-control" required name="loginid" id="loginid" value="<?php if (isset($_POST['loginid'])) echo $_POST['loginid']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label>Name</label>
                <div>
                    <input type="text" title="Your full name." class="form-control" required id="name" name="name" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>">
                </div>

            </div>
            <div class="form-group">
                <label>Email</label>
                <div>
                    <input type="text" class="form-control" required pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" id="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                </div>
            </div>

            <div class="form-group">
                <label>Password</label>
                <div><input type="password" title="Password must contain at least 8 characters, including UPPER/lowercase and numbers." class="form-control" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8" id="password" name="password" value=""></div>
                <span id='message'></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <div>
                    <input type="password" title="Please enter the same password as the one above." class="form-control" minlength="8" required id="confirm_password" name="confirm_password" value="">
                    <span id='message1'></span>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                    <input type="submit" id="register-user" name="register-user" value="Register" class="btnRegister">
                </div>
            </div>
        </div>
    </form>
</section>