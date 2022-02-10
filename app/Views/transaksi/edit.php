<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title><?= $title; ?></title>
</head>

<body>
    <?= $this->extend('templates/index'); ?>

    <?= $this->section('page-content'); ?>
    <h1 class="mt-2" style="text-align: center;">Edit Transaksi Pembayaran</h1>



    <form action="/pembayaran/updatepembayaran/<?= $home['id_pembayaran']; ?>" method="post" style="padding: 20px;" enctype="multipart/form-data">

        <input type="hidden" name="id_kelas" value="<?= $home['id_pembayaran']; ?>">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="id">Nama Petugas</label>
            </div>
            <select class="selectpicker border" data-width="100%" id="id" name="id" data-live-search="true">
                <?php foreach ($users as $s) : ?>
                    <option value="<?= $s['id_user']; ?>" <?= ($s['id_user'] == old('id') || ($home['id'] == $s['id_user'])) ? 'selected' : '' ?>> <?= $s['username']; ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="siswa">Nama Siswa</label>
            </div>
            <select class="selectpicker border " data-width="100%" id="siswa" name="siswa" data-live-search="true">
                <?php foreach ($name as $s) : ?>
                    <option value="<?= $s['id_user']; ?>" <?= ($s['id_user'] == old('siswa') || ($home['siswa'] == $s['id_user'])) ? 'selected' : '' ?>> <?= $s['username']; ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="nisn">Fullname Siswa</label>
            </div>
            <select class="selectpicker border " data-width="100%" id="nisn" name="nisn" data-live-search="true">
                <?php foreach ($nisn as $s) : ?>
                    <option value="<?= $s['nisn']; ?>" <?= ($s['nisn'] == old('nisn') || ($home['nisn'] == $s['nisn'])) ? 'selected' : '' ?>> <?= $s['nama']; ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="nisn">Fullname Siswa</label>
            </div>
            <select class="selectpicker border " data-width="100%" id="nisn" name="nisn" data-live-search="true">
                <?php foreach ($nisn as $s) : ?>
                    <option value="<?= $s['nisn']; ?>" <?= ($s['nisn'] == old('nisn') || ($home['nisn'] == $s['nisn'])) ? 'selected' : '' ?>> <?= $s['nama']; ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="tgl_bayar">Tanggal Bayar</label>
            <input type="number" min="1" max="31" name="tgl_bayar" class="form-control <?= ($validation->hasError('tgl_bayar')) ? 'is-invalid' : ''; ?> " id="tgl_bayar" value="<?= (old('tgl_bayar')) ? old('tgl_bayar') : $home['tgl_bayar']; ?>" placeholder="tanggal bayar">
            <div class="invalid-feedback">
                <?= $validation->getError('tgl_bayar'); ?>
            </div>

        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="bln_bayar">Nama Siswa</label>
            </div>
            <select class="selectpicker border " data-width="100%" id="bln_bayar" name="bln_bayar" data-live-search="true">
                <?php foreach ($bulan as $s) : ?>
                    <option value="<?= $s['bulan_bayar']; ?>" <?= ($s['bulan_bayar'] == old('bln_bayar') || ($home['bln_bayar'] == $s['bulan_bayar'])) ? 'selected' : '' ?>> <?= $s['bulan_bayar']; ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="thn_bayar">Tahun bayar</label>
            <input type="number" min="2019" max="2099" step="1" name="thn_bayar" class="form-control <?= ($validation->hasError('thn_bayar')) ? 'is-invalid' : ''; ?> " id="thn_bayar" value="<?= (old('thn_bayar')) ? old('thn_bayar') : $home['thn_bayar']; ?>" placeholder="tanggal bayar">
            <div class="invalid-feedback">
                <?= $validation->getError('thn_bayar'); ?>
            </div>

        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="id_spp">Fullname Siswa</label>
            </div>
            <select class="selectpicker border " data-width="100%" id="id_spp" name="id_spp" data-live-search="true">
                <?php foreach ($spp as $s) : ?>
                    <option value="<?= $s['id_spp']; ?>" <?= ($s['id_spp'] == old('id_spp') || ($home['id_spp'] == $s['id_spp'])) ? 'selected' : '' ?>> <?= $s['nominal']; ?> </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="jumlah_bayar">kopetensi keahlian</label>
            <input type="text" name="jumlah_bayar" class="form-control <?= ($validation->hasError('jumlah_bayar')) ? 'is-invalid' : ''; ?> " id="jumlah_bayar" value="<?= (old('jumlah_bayar')) ? old('jumlah_bayar') : $home['jumlah_bayar']; ?>" placeholder="First name">
            <div class="invalid-feedback">
                <?= $validation->getError('jumlah_bayar'); ?>
            </div>

        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="id_status">Fullname Siswa</label>
            </div>
            <select class="selectpicker border " data-width="100%" id="id_status" name="id_status" data-live-search="true">
                <?php foreach ($status as $s) : ?>
                    <option value="<?= $s['id_status']; ?>" <?= ($s['id_status'] == old('id_status') || ($home['id_status'] == $s['id_status'])) ? 'selected' : '' ?>> <?= $s['status_pembayaran']; ?> </option>
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