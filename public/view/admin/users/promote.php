
<section class="card m-3 text-center">
    <div class="card-header">
    <?php
        $status=$data['result'];
        if ($status) {
    ?>
            Success
        </div>
        <div class="card-body">
            <h5 class="card-title">User promoted successfully</h5>
    <?php } else { ?>
            Unsuccessful
        </div>
        <div class="card-body">
            <h5 class="card-title">User promoted unsuccessfully</h5>
    <?php } ?>
            <p class="card-text">Click <a href="/admin/u/<?= $data['uid'] ?>">here</a> to view user</p>
        </div>
</section>