<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Contact Detail</h2>
            <?php if (session()->getFlashdata('Message')) : ?>
                <div class="alert alert-success" role="alert">
                    Data <span class="font-weight-bold"><?= $contact['name']; ?></span> Successfully <span class="font-weight-bold"><?= session()->getFlashdata('Message'); ?></span>
                </div>
            <?php endif; ?>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="card-body">
                            <h5 class="card-title"><?= $contact['name']; ?></h5>
                            <p class="card-text"><small class="text-muted"><b>Phone :</b><?= $contact['phone']; ?></small></p>
                            <p class="card-text"><small class="text-muted"><b>Email :</b><?= $contact['email']; ?></small></p>
                            <a href="/contacts/edit/<?= $contact['slug']; ?>" class="btn btn-warning">Edit</a>
                            <form action="/contacts/<?= $contact['id']; ?>" method="post" class="d-inline ">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="Delete">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Do You Want to Delete Contact <?= $contact['name']; ?>?');">Delete</button>
                            </form>
                            <a href="/contacts" class="btn btn-secondary">Back to Contacts List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>