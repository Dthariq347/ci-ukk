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

                <option value="<?= $users[0]['id_user']; ?>"><?= $users[0]['username']; ?> </option>

            </select>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="siswa">Username Siswa</label>
            </div>
            <select class="selectpicker border " data-width="100%" id="siswa" name="siswa" data-live-search="true">


                <option data-subtext="(<?= $name[0]['fullname']; ?>)" value="<?= $name[0]['id_user']; ?>" <?= ($name[0]['id_user'] == old('siswa') || ($home['siswa'] == $name[0]['id_user'])) ? 'selected' : '' ?>> <?= $name[0]['username']; ?> </option>
            </select>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="nisn">Fullname Siswa</label>
            </div>
            <select class="selectpicker border " data-width="100%" id="nisn" name="nisn" data-live-search="true">
                <option value="<?= $nisn[0]['nisn']; ?>" <?= ($nisn[0]['nisn'] == old('nisn') || ($home['nisn'] == $nisn[0]['nisn'])) ? 'selected' : '' ?>> <?= $nisn[0]['nama']; ?> </option>
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
                <label class="input-group-text" for="bln_bayar">Bulan Bayar</label>
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
                <label class="input-group-text" for="id_spp">Nominal SPP</label>
            </div>
            <select class="selectpicker border <?= ($validation->hasError('id_spp')) ? 'is-invalid' : ''; ?>" data-width="100%" id="id_spp" name="id_spp"" value=" <?= old('id_spp'); ?>" title="Bulan Bayar">

                <option selected data-subtext="(<?= $tahun; ?>)" value="<?= $id_spp; ?>" <?= ($id_spp == old('id_spp') || ($home['id_spp'] == $id_spp)) ? 'selected' : '' ?>> <?= $nominal; ?> </option>

            </select>
            <div class="invalid-feedback">
                <?= $validation->getError('id_spp'); ?>
            </div>
        </div>


        <div class="form-group">
            <label for="jumlah_bayar">Jumlah Bayar</label>
            <<<<<<< HEAD <input type="text" name="jumlah_bayar" class="form-control <?= ($validation->hasError('jumlah_bayar')) ? 'is-invalid' : ''; ?> " id="jumlah_bayar" value="<?= (old('jumlah_bayar')) ? old('jumlah_bayar') : $home['jumlah_bayar']; ?>" placeholder="First name" readonly>
                =======
                <input type="text" name="jumlah_bayar" class="form-control <?= ($validation->hasError('jumlah_bayar')) ? 'is-invalid' : ''; ?> " id="jumlah_bayar" value="<?= (old('jumlah_bayar')) ? old('jumlah_bayar') : $home['jumlah_bayar']; ?>" placeholder="First name">
                >>>>>>> d4fce11b3feb0436ab6ca5e1852935f3d44c549b
                <div class="invalid-feedback">
                    <?= $validation->getError('jumlah_bayar'); ?>
                </div>

        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="id_status">Status Pembayaran</label>
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