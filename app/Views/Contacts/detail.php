<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Contact Detail</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="card-body">
                            <h5 class="card-title"><?= $contacts['name']; ?></h5>
                            <p class="card-text"><small class="text-muted"><b>Phone :</b><?= $contacts['phone']; ?></small></p>
                            <p class="card-text"><small class="text-muted"><b>Email :</b><?= $contacts['email']; ?></small></p>
                            <a href="/contacts" class="btn btn-primary">Back to Contacts List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>