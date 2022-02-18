<!DOCTYPE html>
<html lang="en">

<head>
    sc
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title><?= $title; ?></title>
</head>

<body>
    <?= $this->extend('templates/index'); ?>

    <?= $this->section('page-content'); ?>
    <h1 class="mt-2" style="text-align: center;">INPUT DATA TRANSAKSI PEMBAYARAN</h1>



    <form action="/pembayaran/savepembayaran" method="post" style="padding: 20px;" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="col-sm-10">
            <input type="hidden" name="id_pembayaran" value="<?= old('id_pembayaran'); ?>">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="nisn">Nama Siswa</label>
            </div>
            <select class="selectpicker border <?= ($validation->hasError('nisn')) ? 'is-invalid' : ''; ?>" data-width="100%" id="nisn" name="nisn"" value=" <?= old('nisn'); ?>" title="Bulan Bayar">

                <option selected value="<?= $nisn['nisn']; ?>">(<?= $nisn['nis']; ?>) <?= $nisn['nama']; ?> </option>

            </select>
            <div class="invalid-feedback">
                <?= $validation->getError('id_spp'); ?>
            </div>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="id">Nama Petugas</label>
            </div>
            <select class="selectpicker border " data-width="100%" id="id" name="id" value="<?= old('id'); ?>" value="<?= old('id'); ?>" data-live-search="true" title="Nama Petugas....">
                <?php foreach ($users as $s) : ?>
                    <option value="<?= $s['id_user']; ?>"> <?= $s['username']; ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="siswa">Username Siswa</label>
            </div>
            <select class="selectpicker border " data-width="100%" id="siswa" name="siswa" value="<?= old('siswa'); ?>" value="<?= old('siswa'); ?>" data-live-search="true" title="berdasarkan NIS siswa...">
                <?php foreach ($name as $s) : ?>
                    <option data-subtext="(<?= $s['fullname']; ?>)" value="<?= $s['id_user']; ?>"> <?= $s['username']; ?> </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="tgl_bayar">Tanggal bayar</label>
            <input type="number" min="1" max="31" name="tgl_bayar" class="form-control" id="tgl_bayar" value="<?= old('tgl_bayar'); ?>" placeholder="tulis Tanggal bayar anda">

        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="bln_bayar">Bulan Bayar</label>
            </div>
            <select class="selectpicker border <?= ($validation->hasError('bln_bayar')) ? 'is-invalid' : ''; ?>" data-width="100%" id="bln_bayar" name="bln_bayar"" value=" <?= old('bln_bayar'); ?>" data-live-search="true" title="Bulan Bayar">
                <?php foreach ($bulan as $b) : ?>
                    <option value="<?= $b['bulan_bayar']; ?>"> <?= $b['bulan_bayar']; ?> </option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
                <?= $validation->getError('bln_bayar'); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="thn_bayar">Tahun Bayar</label>
            <input type="number" min="2019" max="2099" step="1" name="thn_bayar" class="form-control <?= ($validation->hasError('thn_bayar')) ? 'is-invalid' : ''; ?> " id="thn_bayar" value="<?= old('thn_bayar'); ?>" placeholder="tulis Tahun Bayar anda">
            <div class="invalid-feedback">
                <?= $validation->getError('thn_bayar'); ?>
            </div>

        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="id_spp">Nominal SPP</label>
            </div>
            <select class="selectpicker border <?= ($validation->hasError('id_spp')) ? 'is-invalid' : ''; ?>" data-width="100%" id="id_spp" name="id_spp"" value=" <?= old('id_spp'); ?>" title="Bulan Bayar">

                <option selected data-subtext="(<?= $tahun; ?>)" value="<?= $id_spp; ?>"> <?= $nominal; ?> </option>

            </select>
            <div class="invalid-feedback">
                <?= $validation->getError('id_spp'); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="jumlah_bayar">Jumlah Bayar</label>
            <input type="text" name="jumlah_bayar" class="form-control <?= ($validation->hasError('jumlah_bayar')) ? 'is-invalid' : ''; ?> " id="jumlah_bayar" value="<?= old('jumlah_bayar'); ?>" placeholder="tulis Jumlah Bayar Siswa">
            <div class="invalid-feedback">
                <?= $validation->getError('jumlah_bayar'); ?>
            </div>

        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="id_status">Status</label>
            </div>
            <select class="selectpicker border " data-width="100%" id="id_status" name="id_status" value="<?= old('id_status'); ?>" value="<?= old('id_status'); ?>" title="Status Transaksi">
                <?php foreach ($status as $s) : ?>
                    <option value="<?= $s['id_status']; ?>"><?= $s['status_pembayaran']; ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block">Submit</button>
        </div>
    </form>
    <?= $this->endSection(); ?>
</body>

</html>