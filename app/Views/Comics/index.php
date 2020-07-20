<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h2 class="mt-2">Comic List</h2>
    <div class="row">
        <div class="col-md-5">
            <form action="phpp <?= base_url('contacts'); ?>" method="post">
                <div class="input-group mb-1">
                    <input type="text" class="form-control" placeholder="Search Keyword..." name="keyword">
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" name="submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="/comics/create" class="btn btn-primary my-3">Add Comics List Form</a>
            <?php if (session()->getFlashdata('Message')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('Message'); ?>
                </div>
            <?php endif; ?>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Cover</th>
                        <th scope="col">Title</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($comics as $c) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/<?= $c['cover']; ?>" class="cover" alt=""></td>
                            <td><?= $c['title']; ?></td>
                            <td>
                                <a href="/comics/<?= $c['slug']; ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>