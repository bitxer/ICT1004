<?php $user = $data['user'][0]; ?>
<section class="card border-0 m-3">
    <h1>Details of user</h1>
    <div class="table-responsive m-auto col-sm-8">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th scope="col" class="w-25 text-right">Unique User ID:</th>
                    <td scope="col"><?php echo $user->getField('id')->getValue(); ?></th>
                </tr>
                <tr>
                    <th scope="col" class="w-25 text-right">Username:</th>
                    <td scope="col"><?php echo $user->getField('loginid')->getValue(); ?></th>
                </tr>
                <tr>
                    <th scope="col" class="w-25 text-right">Email:</th>
                    <td scope="col"><?php echo $user->getField('email')->getValue(); ?></th>
                </tr>
                <tr>
                    <th scope="col" class="w-25 text-right">Name: </th>
                    <td scope="col"><?php echo $user->getField('name')->getValue(); ?></th>
                </tr>
                <tr>
                    <th scope="col" class="w-25 text-right">Admin user: </th>
                    <!-- <td scope="col"><?php echo 'YES' ? $user->getField('isadmin')->getValue() === 1: 'NO'; ?></th> -->
                    <td scope="col"><?php echo $user->getField('isadmin')->getValue() == 1 ? 'Yes' : 'No'; ?></th>
                </tr>
            </tbody>
        </table>
    </div>
</section>