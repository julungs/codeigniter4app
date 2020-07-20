<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h2 class="mt-2">Contacts List</h2>
    <div class="row">
        <div class="col-md-5">
            <form action="<?= base_url('contacts/index'); ?>" method="post">
                <div class="input-group mb-1">
                    <input type="text" class="form-control" placeholder="Search Keyword..." name="keyword" autocomplete="off" autofocus>
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" name="submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="/contacts/create" class="btn btn-primary my-3">Add Contacts List Form</a>
            <?php if (session()->getFlashdata('Message')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('Message'); ?>
                </div>
            <?php endif; ?>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($contacts as $c) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $c['name']; ?></td>
                            <td><?= $c['phone']; ?></td>
                            <td><?= $c['email']; ?></td>
                            <td>
                                <a href="/contacts/delete/<?= $c['slug']; ?>" class="btn btn-success">Detail</a>
                                <a href="/contacts/edit/<?= $c['slug']; ?>" class="btn btn-warning">Edit</a>
                                <form action="/contacts/<?= $c['id']; ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="Delete">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do You Want to Delete Contact <?= $c['name']; ?>?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links(); ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>