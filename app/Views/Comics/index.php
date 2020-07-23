<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h2 class="mt-2">Comic List</h2>
    <div class="row">
        <div class="col-md-5">
            <form action="" method="post">
                <div class="input-group mb-1">
                    <input type="text" class="form-control" placeholder="Search Keyword..." name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="submit">Search</button>
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
                    Data <span class="font-weight-bold"><?= $comics['title']; ?></span> Successfully <span class="font-weight-bold"><?= session()->getFlashdata('Message'); ?></span>
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
                    <?php $i = 1 + ($perPage * ($currentPage - 1)); ?>
                    <?php foreach ($comics as $comics) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/<?= $comics['cover']; ?>" class="cover" alt=""></td>
                            <td><?= $comics['title']; ?></td>
                            <td>
                                <a href="/comics/<?= $comics['slug']; ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links($group, $pagination); ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>