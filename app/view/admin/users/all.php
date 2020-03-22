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
                    <th>Suspended</th>
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
                            <td><?= htmlspecialchars($user->getField('loginid')->getValue()); ?></td>
                            <td><?= htmlspecialchars($user->getField('email')->getValue()); ?></td>
                            <td><?= htmlspecialchars($user->getField('name')->getValue()); ?></td>
                            <td><?= $user->getField('isadmin')->getValue() == 1 ? 'Yes' : 'No'; ?></td>
                            <td><?= $user->getField('suspended')->getValue() == 1 ? 'Yes' : 'No'; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
<?php } else { ?>
    <h5>No registered users found</h2>
<?php } ?>
</section>
