<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
</head>

<body>
    <?= $this->extend('templates/index'); ?>

    <?= $this->section('page-content'); ?>
    <div class="container">
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-1 my-2 my-md-0 mw-100 navbar-search" action="" method="post">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Cari admin / Petugas.." aria-label="Search" aria-describedby="basic-addon2" name="keyword">
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit" name="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
        <a href="/admin/createpetugas/" class="btn btn-success">tambah data Petugas / admin</a>
        <div class="row">
            <div class="col">

                <h1 class="mt-2">DAFTAR PETUGAS / ADMIN</h1>
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif; ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">email</th>
                            <th scope="col">username</th>
                            <th scope="col">fullname</th>
                            <th scope="col">Role</th>
                            <th scope="col">Aksi</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 + (3 * ($currentPage - 1)) ?>

                        <?php foreach ($users as $a) : ?>

                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?php echo $a['email'] ?></td>
                                <td><?php echo $a['username'] ?></td>
                                <td><?php echo $a['fullname'] ?></td>
                                <td><?php echo $a['name'] ?></td>

                                <td><a href="/admin/editpetugas/<?= $a['id_user']; ?>" class="btn btn-warning">Edit</a></td>
                                <td>
                                    <form action="/admin/deletepetugas/<?= $a['id_user']; ?>" method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" onclick=" return confirm('apakah anda ingin delete data'); ">Delate</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $pager->links('users', 'read_pagination') ?>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>
</body>

</html>