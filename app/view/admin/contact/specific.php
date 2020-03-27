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
                    <td><?= htmlspecialchars($contact->getField('id')->getValue()); ?></td>
                </tr>
                <tr>
                    <th scope="col" class="w-25 text-right">Requested By:</th>
                    <td><?= htmlspecialchars($contact->getField('name')->getValue()); ?></td>
                </tr>
                <tr>
                    <th scope="col" class="w-25 text-right">Email:</th>
                    <td><?= htmlspecialchars($contact->getField('email')->getValue()); ?></td>
                </tr>
                <tr>
                    <th scope="col" class="w-25 text-right">Message:</th>
                    <td><?= htmlspecialchars($contact->getField('message')->getValue()); ?></td>
                </tr>
            </tbody>
        </table>
        <form class="text-center" id="contactAction">
            <input type="hidden" name="<?= FORM_CSRF_FIELD ?>" value="<?= $_SESSION[SESSION_CSRF_TOKEN]; ?>">
            <input type="hidden" name="id" value="<?= htmlspecialchars($contact->getField('id')->getValue()); ?>">
            <input type="submit" name="delete" class="btn btn-danger" value="Delete request"/>
        </form>
    </div>
</section>