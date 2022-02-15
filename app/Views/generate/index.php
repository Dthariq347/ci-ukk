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
        <div class="row">

            <div class="col">
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-1 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-1 small" placeholder="Berdasarkan Bulan..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <h1 class="mt-2" style="text-align: center;">GENERATE LAPORAN</h1>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-download fa-sm text-white-50"></i>
                    Generate Laporan
                </button>

                <!-- Modal -->
                <form action="/Generate/printpdf" method="post" style="padding: 20px;" enctype="multipart/form-data">
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Generate Laporan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="bln_bayar">Bulan Bayar</label>
                                        </div>
                                        <select class="selectpicker border " data-width="100%" id="bln_bayar" name="bln_bayar" value="<?= old('bln_bayar'); ?>" value="<?= old('bln_bayar'); ?>" data-live-search="true" title="Bulan Bayar">
                                            <?php foreach ($bulan as $b) : ?>
                                                <option value="<?= $b['bulan_bayar']; ?>"> <?= $b['bulan_bayar']; ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="thn_bayar">Tahun Bayar</label>
                                        <input type="number" min="2019" max="2099" step="1" type="number" min="1900" max="2099" step="1" name="thn_bayar" class="form-control <?= ($validation->hasError('thn_bayar')) ? 'is-invalid' : ''; ?> " id="thn_bayar" value="<?= old('thn_bayar'); ?>" placeholder="tulis Tahun Bayar anda">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('thn_bayar'); ?>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-block" formtarget="_blank">
                                            <i class="fas fa-download fa-sm text-white-50"></i>
                                            Generate
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif; ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Nama Kelas</th>
                            <th scope="col">Bulan bayar</th>
                            <th scope="col">Tahun bayar</th>
                            <th scope="col">Status</th>
                            <th scope="col">jumlah pembayaran</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>

                        <?php foreach ($read as $a) : ?>
                            <tr>
                                <td><?php echo $a['nis'] ?></td>
                                <td><?php echo $a['nama'] ?></td>
                                <td><?php echo $a['nama_kelas'] ?></td>
                                <td><?php echo $a['bln_bayar'] ?></td>
                                <td><?php echo $a['thn_bayar'] ?></td>
                                <?php if ($a['jumlah_bayar'] >= $a['nominal']) : ?>
                                    <td>
                                        <button class="btn btn-success">lunas</button>
                                    </td>
                                <?php else : ?>
                                    <td>
                                        <button class="btn btn-warning">belum lunas</button>
                                    </td>
                                <?php endif; ?>
                                <td><?php echo $a['jumlah_bayar'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $pager->links('pembayaran', 'read_pagination') ?>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>
</body>

</html>