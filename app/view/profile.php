<section class='card border-dark mb-3' id="profile" style="max-width: 35rem; ">
    <h1 class="card-header">My Profile</h1>

    <form class="profile card-body" method="post" action="/account/update_profile">

        <?php
            if (!empty($_SESSION['msg'])) {
                echo "<div id='myMsg'>" . $_SESSION['msg'] . "</div>";
                unset($_SESSION['msg']);
            }
        ?>
        <br>

        <label>User Id:</label>
        <article class="form-group">
            <?php
                $user = $data['loginid'];
                echo '<input class="form-group" type="text" name="userid" placeholder="Enter Your user id" maxlength="50" value=' . $user . ' aria-label="loginid">';
            ?>
            <button class="btn btn-primary" type="submit" name="update" value="buserid">Update User id</button>
        </article>

        <label>Email:</label>
        <article class="form-group">
            <?php
                $email = $data['email'];
                echo '<input class="form-group" type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Enter Your new Email" maxlength="100" value=' . $email . ' aria-label="email">';
            ?>
            <button class="btn btn-primary" type="submit" name="update" value="bemail">Update Email</button>
        </article>

        <label>Name:</label>
        <article class="form-group">
            <?php
                $name = $data['name'];
                echo '<input class="form-group" type="text" name="name" placeholder="Enter Your new Name" maxlength="50"     value=' . $name . ' aria-label="name">';
            ?>
            <button class="btn btn-primary" type="submit" name="update" value="bname">Update Name</button>
        </article>

        <label>Current Password:</label>
        <article class="form-group">
            <input class="form-group" type="password" minlength="8" name="cpassword" placeholder="Enter current password" aria-label="cpassword">
        </article>

        <label>New Password:</label>
        <article class="form-group">
            <input class="form-group" type="password" title="Password must contain at least 8 characters, including UPPER/lowercase and numbers." pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8" name="npassword" placeholder="Enter new password" aria-label="npassword">
        </article>

        <label>Confirm New Password:</label>
        <article class="form-group">
            <input class="form-group" type="password" minlength="8" name="ncpassword" placeholder="Enter new confirm password" aria-label="ncpassword">
            <button class="btn btn-primary" type="submit" name="update" value="bpassword">Change Password</button>
        </article>

        <label id="profilenote">Note: if you change your password, you will be signed out, sign back in with the new password</label>
        <input type="hidden" name="<?= FORM_CSRF_FIELD ?>" value="<?= $_SESSION[SESSION_CSRF_TOKEN] ?>">
    </form>
</section>