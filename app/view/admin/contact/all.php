<section class="card border-0 m-3">
    <h1>Registered users</h1>
<?php if (isset($data['contact'])) { ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <th>ID</th>
                    <th>Requested by</th>
                    <th>Contact Email</th>
                </thead>
                <tbody>
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
                </tbody>
            </table>
        </div>
<?php } else { ?>
    <h5>No open contact requests</h2>
<?php } ?>
</section>
