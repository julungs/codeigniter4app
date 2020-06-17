<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-5">Comic List</h2>
            <table class="table table-light">
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
                            <td><a href="" class="btn btn-success">Detail</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>