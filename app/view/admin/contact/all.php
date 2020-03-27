<section class="card border-0 m-3">
    <h1>Contact Requests</h1>
<?php if (isset($data['contact'])) { ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Requested by</th>
                    <th>Contact Email</th>
                </tr>
                <?php
                    foreach ($data['contact'] as $contact) { 
                        $id = $contact->getField('id')->getValue();
                ?>
                    <tr>
                        <td>
                            <a href="/admin/contact/<?= $id ?>"><?= $id ?></a>
                        </td>
                        <td><?= htmlspecialchars($contact->getField('name')->getValue()); ?></td>
                        <td><?= htmlspecialchars($contact->getField('email')->getValue()); ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
<?php } else { ?>
    <h5>No open contact requests</h2>
<?php } ?>
</section>
