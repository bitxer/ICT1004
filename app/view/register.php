<form class="register col-sm-auto" name="frmRegistration" method="post" action="/register/register_process">
    <h2 class="form-group col-sm-auto">Registration</h2>
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
        <div class="form-group col-sm-auto">
            <label for="loginid">Profile Name:</label>
            <div>
                <input type="text" title="This will be your profile name." class="form-control" required name="loginid" id="loginid">
            </div>
        </div>
        <div class="form-group col-sm-auto">
            <label>Name</label>
            <div>
                <input type="text" title="Your full name." class="form-control" required id="name" name="name">
            </div>

        </div>
        <div class="form-group col-sm-auto">
            <label>Email</label>
            <div>
                <input type="email" class="form-control" required pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" id="email" name="email">
            </div>
        </div>
    </div>

    <div class="form-group col-sm-auto">
        <label>Password</label>
        <div><input type="password" title="Password must contain at least 8 characters, including UPPER/lowercase and numbers." class="form-control" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8" id="password" name="password"></div>
        <span id='message'></span>
    </div>
    <div class="form-group col-sm-auto">
        <label>Confirm Password</label>
        <div>
            <input type="password" title="Please enter the same password as the one above." class="form-control" minlength="8" required id="confirm_password" name="confirm_password">
            <span id='message1'></span>
        </div>
    </div>
    <div class="form-group col-sm-auto">
        <div class="terms">
            <input type="checkbox" required name="terms"> I accept terms and conditions
        </div>
        <div>
            <input type="hidden" name="<?= FORM_CSRF_FIELD ?>" value="<?= $_SESSION[SESSION_CSRF_TOKEN]; ?>">
            <button type="submit" id="register-user" name="register-user" class="btn btn-primary">Register</button>
        </div>
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "sqlerror") {
                echo '<p id="sqlerror">Please enter the fields again.</p>';
            }
        }
        ?>
    </div>
</form>