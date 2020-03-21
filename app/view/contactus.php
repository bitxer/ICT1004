<div class="card" id="contactus">
    <form class="contactus card-body" id="contact" method="post" action="/main/contact_us">
        <h1 class="card-header" id="contactheader">Contact Us</h1>
        <?php
            if (!empty($_SESSION['contactus'])) {
                echo "<div id='myMsg'>" . $_SESSION['contactus'] . "</div>";
                unset($_SESSION['contactus']);
            }
        ?>
        <br>
        <label>Full Name:</label>
        <section class="form-group">
            <input class="form-group col-sm" type="text" name="fullname" required aria-label="fullname">
        </section>

        <label>Email:</label>
        <section class="form-group">
            <input class="form-group col-sm" type="text" name="email" value="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required aria-label="email">
        </section>

        <label>Description:</label>
        <section class="form-group">
            <textarea class="form-group col-sm" type="text" name="description" rows="6" cols="50" required aria-label="description"></textarea>
        </section>

        <button class="btn btn-primary" type="submit" name="update" value="bname">Submit</button>
    </form>
</div>