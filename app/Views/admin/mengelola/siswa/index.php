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
    <h1 class="mt-2" style="text-align: center;">INPUT DATA SISWA</h1>



    <form action="/admin/savesiswa" method="post" style="padding: 20px;" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="col-sm-10">
            <input type="hidden" name="nisn" value="<?= old('nisn'); ?>">
        </div>
        <div class="form-group">
            <label for="nisn">NISN</label>
            <input type="text" name="nisn" class="form-control  <?= ($validation->hasError('nisn')) ? 'is-invalid' : ''; ?> " id="nisn" value="<?= old('nisn'); ?>" placeholder="tulis nisn siswa...">
            <div class="invalid-feedback">
                <?= $validation->getError('nisn'); ?>
            </div>

            </dinisn <div class="form-group">
            <label for="nis">NIS</label>
            <input type="text" name="nis" class="form-control  <?= ($validation->hasError('nis')) ? 'is-invalid' : ''; ?> " id="nis" value="<?= old('nis'); ?>" placeholder="tulis nis siswa...">
            <div class="invalid-feedback">
                <?= $validation->getError('nis'); ?>
            </div>

        </div>
        <div class="form-group">
            <label for="nama">NAMA</label>
            <input type="text" name="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?> " id="nama" value="<?= old('nama'); ?>" placeholder="tulis nama lengkap siswa...">
            <div class="invalid-feedback">
                <?= $validation->getError('nama'); ?>
            </div>

        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="id_kelas">KELAS</label>
            </div>
            <select class="selectpicker border <?= ($validation->hasError('id_kelas')) ? 'is-invalid' : ''; ?>" data-width="100%" id="id_kelas" name="id_kelas" data-live-search="true" title="Kelas Siswa...">
                <?php foreach ($jamet as $s) : ?>
                    <option value="<?= $s['id_kelas']; ?>"> <?= $s['nama_kelas']; ?> </option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
                <?= $validation->getError('id_kelas'); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" value="<?= old('alamat'); ?>" name="alamat" id="alamat" placeholder="Alamat lengkap siswa..." rows="3"></textarea>
            <div class="invalid-feedback">
                <?= $validation->getError('alamat'); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="no_telp">nomer telp</label>
            <input type="text" name="no_telp" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?> " id="no_telp" value="<?= old('no_telp'); ?>" placeholder="tulis nomer telp lengkap">
            <div class="invalid-feedback">
                <?= $validation->getError('no_telp'); ?>
            </div>

        </div>
        <div class="form-group">

            <button type="submit" class="btn btn-success btn-block">Submit</button>

        </div>
    </form>
    <?= $this->endSection(); ?>
</body>

</html>