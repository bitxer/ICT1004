<section class="card border-0 m-3">
    <h1>Registered users</h1>
<?php if (isset($data['users'])) { ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Rights</th>
                </thead>
                <tbody>
                    <?php foreach ($data['users'] as $user) { ?>
                        <tr>
                            <td><?php echo $user->getField('id')->getValue(); ?></td>
                            <td><?php echo $user->getField('loginid')->getValue(); ?></td>
                            <td><?php echo $user->getField('email')->getValue(); ?></td>
                            <td><?php echo $user->getField('name')->getValue(); ?></td>
                            <td><?php echo $user->getField('isadmin')->getValue(); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
<?php } else { ?>
    <h5>No registered users found</h2>
<?php } ?>
</section>
