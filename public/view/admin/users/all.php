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
                    <?php
                        foreach ($data['users'] as $user) { 
                            $id = $user->getField('id')->getValue();
                    ?>
                        <tr>
                            <td>
                                <a href="/admin/u/<?= $id ?>"><?= $id ?></a>
                            </td>
                            <td><?= $user->getField('loginid')->getValue(); ?></td>
                            <td><?= $user->getField('email')->getValue(); ?></td>
                            <td><?= $user->getField('name')->getValue(); ?></td>
                            <td><?= $user->getField('isadmin')->getValue(); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
<?php } else { ?>
    <h5>No registered users found</h2>
<?php } ?>
</section>
