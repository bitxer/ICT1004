
<div class='card border-dark mb-3' id="profile" style="max-width: 35rem; ">
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
        <section class="form-group">
            <?php
            $user = $data['loginid'];
            echo '<input class="form-group" type="text" name="userid" placeholder="Enter Your user id" maxlength="50" value=' . $user . '>';
            ?>
            <button class="btn btn-primary" type="submit" name="update" value="buserid">Update User id</button>
        </section>

        <label>Email:</label>
        <section class="form-group">
            <?php
            $email = $data['email'];
            echo '<input class="form-group" type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Enter Your new Email" maxlength="100" value=' . $email . '>';
            ?>
            <button class="btn btn-primary" type="submit" name="update" value="bemail">Update Email</button>
        </section>

        <label>Name:</label>
        <section class="form-group">
            <?php
            $name = $data['name'];
            echo '<input class="form-group" type="text" name="name" placeholder="Enter Your new Name" maxlength="50"     value=' . $name . '>';
            ?>
            <button class="btn btn-primary" type="submit" name="update" value="bname">Update Name</button>
        </section>

        <label>Current Password:</label>
        <section class="form-group">
            <input class="form-group" type="password" minlength="8" name="cpassword" placeholder="Enter current password">
        </section>

        <label>New Password:</label>
        <section class="form-group">
            <input class="form-group" type="password" title="Password must contain at least 8 characters, including UPPER/lowercase and numbers." pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8" name="npassword" placeholder="Enter new password">
        </section>

        <label>Confirm New Password:</label>
        <section class="form-group">
            <input class="form-group" type="password" minlength="8" name="ncpassword" placeholder="Enter new confirm password">
            <button class="btn btn-primary" type="submit" name="update" value="bpassword">Change Password</button>
        </section>

        <label id="profilenote">Note: if you change your password, you will be signed out, sign back in with the new password</label>
        <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
    </form>
</div>
