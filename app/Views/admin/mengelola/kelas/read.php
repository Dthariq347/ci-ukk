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
                <input type="text" class="form-control bg-light border-1 small" placeholder="Cari Nama Kelas...." aria-label="Search" aria-describedby="basic-addon2" name="keyword">
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit" name="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
        <a href="/admin/createkelas" class="btn btn-success ">tambah data Kelas</a>
        <div class="row">
            <div class="col">

                <h1 class="mt-3" style="text-align: center;">DAFTAR KELAS</h1>
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif; ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id Kelas</th>
                            <th scope="col">Nama Kelas</th>
                            <th scope="col">aksi</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>

                        <?php foreach ($read as $a) : ?>

                            <tr>

                                <td><?php echo $a['id_kelas'] ?></td>
                                <td><?php echo $a['nama_kelas'] ?></td>

                                <td><a href="/admin/editkelas/<?= $a['id_kelas']; ?>" class="btn btn-warning">Edit</a></td>
                                <td>
                                    <form action="/admin/deletekelas/<?= $a['id_kelas']; ?>" method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" onclick=" return confirm('apakah anda ingin delete data'); ">Delate</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $pager->links('kelas', 'read_pagination') ?>
            </div>
        </div>
    </div>

    <?= $this->endSection(); ?>
</body>

</html>