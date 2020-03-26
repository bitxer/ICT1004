<?php
include_once "../app/constants.php";
$user = $data['user'][0]; 
$isadmin = $user->getField('isadmin')->getValue() == 1;
$suspended = $user->getField('suspended')->getValue() == 1;
?>
<section class="card border-0 m-3">
    <h1>Details of user</h1>
    <div class="table-responsive m-auto col-sm-8">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th scope="col" class="w-25 text-right">Unique User ID:</th>
                    <td scope="col"><?= htmlspecialchars($user->getField('id')->getValue()); ?></td>
                </tr>
                <tr>
                    <th scope="col" class="w-25 text-right">Username:</th>
                    <td scope="col"><?= htmlspecialchars($user->getField('loginid')->getValue()); ?></td>
                </tr>
                <tr>
                    <th scope="col" class="w-25 text-right">Email:</th>
                    <td scope="col"><?= htmlspecialchars($user->getField('email')->getValue()); ?></td>
                </tr>
                <tr>
                    <th scope="col" class="w-25 text-right">Name: </th>
                    <td scope="col"><?= htmlspecialchars($user->getField('name')->getValue()); ?></td>
                </tr>
                <tr>
                    <th scope="col" class="w-25 text-right">Admin user: </th>
                    <td scope="col"><?= $isadmin ? 'Yes' : 'No'; ?></td>
                </tr><tr>
                    <th scope="col" class="w-25 text-right">Suspended</th>
                    <td scope="col"><?= $suspended ? 'Yes' : 'No'; ?></td>
                </tr>
                <tr>
                    <td scope="col" colspan="2" class="text-center">Click <a href="/blog/u/<?= htmlspecialchars($user->getField('loginid')->getValue()); ?>">here</a> to view blog</td>
                </tr>
            </tbody>
        </table>
        <form class="text-center" id="userAction">
            <input type="hidden" name="<?= FORM_CSRF_FIELD ?>" value="<?= $_SESSION[SESSION_CSRF_TOKEN]; ?>">
            <input type="hidden" name="uid" value="<?= htmlspecialchars($user->getField('id')->getValue()); ?>">
            <?php if ($isadmin) { ?>
                <input type="submit" name="demote" class="btn btn-danger" value="Remove admin rights"/>
            <?php } else  { ?>
                <input type="submit" name="promote" class="btn btn-success" value="Promote to admin"/>
            <?php }
                if ($suspended) { ?>
                <input type="submit" name="unsuspend" class="btn btn-danger" value="Unsuspend user"/>
            <?php } else  { ?>
                <input type="submit" name="suspend" class="btn btn-danger" value="Suspend user"/>
            <?php } ?>
        </form>
    </div>
</section>