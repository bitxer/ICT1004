<section class="col-sm-9 border-0 m-auto">
    <div class="m-3">
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
                        <input type="text" title="This will be your profile name." class="form-control" name="loginid" id="loginid" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <div>
                        <input type="text" title="Your full name." class="form-control" id="name" name="name" required>
                    </div>

                </div>
                <div class="form-group">
                    <label>Email</label>
                    <div>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div>
                        <input type="password" title="Password must contain at least 8 characters, including UPPER/lowercase and numbers." class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8" id="password" name="password" required>
                </div>
                    <span id='message'></span>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <div>
                        <input type="password" title="Please enter the same password as the one above." class="form-control" minlength="8" id="confirm_password" name="confirm_password" required>
                        <span id='message1'></span>
                    </div>
                </div>
                <div class="form-group text-center">
                    <input type="hidden" name="<?=FORM_CSRF_FIELD?>" value="<?=$_SESSION[SESSION_CSRF_TOKEN]?>">
                    <input type="submit" name="setup" value="Setup Application" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</section>