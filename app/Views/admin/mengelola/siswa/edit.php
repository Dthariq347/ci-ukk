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
    <h1 class="mt-2" style="text-align: center;">Edit Data Siswa</h1>



    <form action="/admin/updatesiswa/<?= $home['nisn']; ?>" method="post" style="padding: 20px;" enctype="multipart/form-data">

        <input type="hidden" name="nisn" value="<?= $home['nisn']; ?>">
        <div class="form-group">
            <label for="nisn">nisn</label>
            <input type="text" name="nisn" class="form-control <?= ($validation->hasError('nisn')) ? 'is-invalid' : ''; ?> " id="nisn" value="<?= (old('nisn')) ? old('nisn') : $home['nisn']; ?>" placeholder="Kode Jabatan" readonly>
            <div class="invalid-feedback">
                <?= $validation->getError('nisn'); ?>
            </div>

        </div>
        <div class="form-group">
            <label for="nis">nis</label>
            <input type="text" name="nis" class="form-control <?= ($validation->hasError('nis')) ? 'is-invalid' : ''; ?> " id="nis" value="<?= (old('nis')) ? old('nis') : $home['nis']; ?>" placeholder="First name">
            <div class="invalid-feedback">
                <?= $validation->getError('nis'); ?>
            </div>

        </div>
        <div class="form-group">
            <label for="nama">nama</label>
            <textarea class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" id="nama" placeholder="tunjangan trasnportasi lengkap..." rows="3"><?= (old('nama')) ? old('nama') : $home['nama']; ?></textarea>
            <div class="invalid-feedback">
                <?= $validation->getError('nama'); ?>
            </div>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="id_kelas">Nama Kelas</label>
            </div>
            <select class="selectpicker border " data-width="100%" id="id_kelas" name="id_kelas" data-live-search="true">
                <?php foreach ($jamet as $s) : ?>
                    <option value="<?= $s['id_kelas']; ?>" <?= ($s['id_kelas'] == old('id_kelas') || ($home['id_kelas'] == $s['id_kelas'])) ? 'selected' : '' ?>> <?= $s['nama_kelas']; ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?> " id="alamat" value="<?= (old('alamat')) ? old('alamat') : $home['alamat']; ?>" placeholder="First name">
            <div class="invalid-feedback">
                <?= $validation->getError('alamat'); ?>
            </div>

        </div>
        <div class="form-group">
            <label for="no_telp">No telp</label>
            <input type="text" name="no_telp" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?> " id="no_telp" value="<?= (old('no_telp')) ? old('no_telp') : $home['no_telp']; ?>" placeholder="First name">
            <div class="invalid-feedback">
                <?= $validation->getError('no_telp'); ?>
            </div>

        </div>

        <button type="submit" class="btn btn-success btn-block">Edit</button>
    </form>
    <?= $this->endSection(); ?>
</body>

</html>