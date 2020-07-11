<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-5">Comic Detail</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="/img/<?= $comics['cover']; ?>" class="card-img" alt="...">
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
                                <a href="/comics" class="btn btn-secondary">Back to Comics List</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>