<?php
include_once "../app/constants.php";
$contact = $data['contact'][0]; 
?>
<section class="card border-0 m-3">
    <h1>Details of Contact Request</h1>
    <div class="table-responsive m-auto col-sm-8">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th scope="col" class="w-25 text-right">Request ID:</th>
                    <td scope="col"><?= htmlspecialchars($contact->getField('id')->getValue()); ?></td>
                </tr>
                <tr>
                    <th scope="col" class="w-25 text-right">Requested By:</th>
                    <td scope="col"><?= htmlspecialchars($contact->getField('name')->getValue()); ?></td>
                </tr>
                <tr>
                    <th scope="col" class="w-25 text-right">Email:</th>
                    <td scope="col"><?= htmlspecialchars($contact->getField('email')->getValue()); ?></td>
                </tr>
                <tr>
                    <th scope="col" class="w-25 text-right">Message: </th>
                    <td scope="col"><?= htmlspecialchars($contact->getField('message')->getValue()); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</section>