<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Comic Detail</h2>
            <?php if (session()->getFlashdata('Message')) : ?>
                <div class="alert alert-success" role="alert">
                    Data <span class="font-weight-bold"><?= $comics['title']; ?></span> Successfully <span class="font-weight-bold"><?= session()->getFlashdata('Message'); ?></span>
                </div>
            <?php endif; ?>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="/img/<?= $comics['cover']; ?>" class="card-img" alt="Comics cover">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $comics['title']; ?></h5>
                            <p class="card-text"><b>Author :</b><?= $comics['author']; ?></p>
                            <p class="card-text"><small class="text-muted"><b>Publisher :</b><?= $comics['publisher']; ?></small></p>
                            <a href="/comics/edit/<?= $comics['slug']; ?>" class="btn btn-warning">Edit</a>
                            <form action="/comics/<?= $comics['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="Delete">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Do You Want to Delete Comics <?= $comics['title']; ?>?');">Delete</button>
                            </form>
                            <a href="/comics" class="btn btn-secondary">Back to Comics List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>