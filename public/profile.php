
<h1>My Profile</h1>
<div>
    <form class="profile" method="post" action="/account/update_profile">

        <?php
        if (!empty($_SESSION['msg'])) {
            echo "<div id='myMsg'>" . $_SESSION['msg'] . "</div>";
            unset($_SESSION['msg']);
        }
        ?>
        <br>

        <label>User Id:</label>
        <div class="form-group">
            <?php
            $user = $data['loginid'];
            echo '<input class="form-group" type="text" name="userid" placeholder="Enter Your user id" maxlength="50" value=' . $user . '>';
            ?>
            <button class="btn btn-primary" type="submit" name="update" value="buserid">Update User id</button>
        </div>

        <label>Email:</label>
        <div class="form-group">
            <?php
            $email = $data['email'];
            echo '<input class="form-group" type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Enter Your new Email" maxlength="100" value=' . $email . '>';
            ?>

            <button class="btn btn-primary" type="submit" name="update" value="bemail">Update Email</button>
        </div>
        <label>Name:</label>
        <div class="form-group">
            <?php
            $name = $data['name'];
            echo '<input class="form-group" type="text" name="name" placeholder="Enter Your new Name" maxlength="50"     value=' . $name . '>';
            ?>
            <button class="btn btn-primary" type="submit" name="update" value="bname">Update Name</button>
        </div>
        <label>Current Password:</label>
        <div class="form-group">
            <input class="form-group" type="password" minlength="8" name="cpassword" placeholder="Enter current password">
        </div>
        <label>New Password:</label>
        <div class="form-group">
            <input class="form-group" type="password" minlength="8" name="npassword" placeholder="Enter new password">
        </div>
        <label>Confirm New Password:</label>
        <div class="form-group">
            <input class="form-group" type="password" minlength="8" name="ncpassword" placeholder="Enter new confirm password">
            <button class="btn btn-primary" type="submit" name="update" value="bpassword">Change Password</button>
        </div>
        <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
    </form>
</div>
