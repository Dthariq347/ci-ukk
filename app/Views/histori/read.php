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
        <?php if (in_groups('admin')) : ?>
            <div class="row">

                <div class="col">
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-1 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-1 small" placeholder="Berdasarkan Nama..." aria-label="Search" aria-describedby="basic-addon2" name="keyword">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit" name="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <h1 class="mt-2" style="text-align: center;">HISTORY PEMBAYARAN</h1>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID pembayaran</th>
                                <th scope="col">ID Petugas</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Bulan bayar</th>
                                <th scope="col">Tahun bayar</th>
                                <th scope="col">nominal</th>
                                <th scope="col">jumlah pembayaran</th>
                                <th scope="col">Keterangan</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>

                            <?php foreach ($read as $a) : ?>
                                <tr>
                                    <td><?php echo $a['id_pembayaran'] ?></td>
                                    <td><?php echo $a['username'] ?></td>
                                    <td><?php echo $a['nama'] ?></td>
                                    <td><?php echo $a['bln_bayar'] ?></td>
                                    <td><?php echo $a['thn_bayar'] ?></td>
                                    <td><?php echo $a['nominal'] ?></td>
                                    <td><?php echo $a['jumlah_bayar'] ?></td>
                                    <td><?php echo $a['status_pembayaran'] ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $pager->links('pembayaran', 'read_pagination') ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (in_groups('petugas')) : ?>
            <div class="row">

                <div class="col">
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-1 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-1 small" placeholder="Berdasarkan Nama..." aria-label="Search" aria-describedby="basic-addon2" name="keyword">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit" name="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <h1 class="mt-2" style="text-align: center;">HISTORY PEMBAYARAN</h1>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID pembayaran</th>
                                <th scope="col">ID Petugas</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Bulan bayar</th>
                                <th scope="col">Tahun bayar</th>
                                <th scope="col">nominal</th>
                                <th scope="col">jumlah pembayaran</th>
                                <th scope="col">Keterangan</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>

                            <?php foreach ($read as $a) : ?>
                                <tr>
                                    <td><?php echo $a['id_pembayaran'] ?></td>
                                    <td><?php echo $a['username'] ?></td>
                                    <td><?php echo $a['nama'] ?></td>
                                    <td><?php echo $a['bln_bayar'] ?></td>
                                    <td><?php echo $a['thn_bayar'] ?></td>
                                    <td><?php echo $a['nominal'] ?></td>
                                    <td><?php echo $a['jumlah_bayar'] ?></td>
                                    <?php if ($a['status_pembayaran'] == 'Lunas') : ?>
                                        <td><button class="btn btn-success"><?= $a['status_pembayaran']; ?></button></td>

                                    <?php else : ?>
                                        <td><button class="btn btn-warning"><?= $a['status_pembayaran']; ?></button></td>
                                    <?php endif; ?>


                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $pager->links('pembayaran', 'read_pagination') ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (in_groups('siswa')) : ?>
            <div class="row">
                <div class="col">

                    <h1 class="mt-3">HISTORY PEMBAYARAN</h1>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nomer</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Bulan bayar</th>
                                <th scope="col">Tahun bayar</th>
                                <th scope="col">nominal</th>
                                <th scope="col">jumlah pembayaran</th>
                                <th scope="col">Keterangan</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($read as $a) : ?>

                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?php echo $a['nama'] ?></td>
                                    <td><?php echo $a['bln_bayar'] ?></td>
                                    <td><?php echo $a['thn_bayar'] ?></td>
                                    <td><?php echo $a['nominal'] ?></td>
                                    <td><?php echo $a['jumlah_bayar'] ?></td>
                                    <?php if ($a['jumlah_bayar'] >= $a['nominal']) : ?>
                                        <td>
                                            <button class="btn btn-success">lunas</button>
                                        </td>
                                    <?php else : ?>
                                        <td>
                                            <button class="btn btn-danger">belum lunas</button>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $pager->links('pembayaran', 'read_pagination') ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?= $this->endSection(); ?>
</body>

</html>