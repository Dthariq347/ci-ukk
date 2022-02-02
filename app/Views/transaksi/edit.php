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
    <h1 class="mt-2" style="text-align: center;">Edit Data Kelas</h1>



    <form action="/admin/updatekelas/<?= $home['id_kelas']; ?>" method="post" style="padding: 20px;" enctype="multipart/form-data">

        <input type="hidden" name="id_kelas" value="<?= $home['id_kelas']; ?>">
        <div class="form-group">
            <label for="id_kelas">nama kelas</label>
            <input type="text" name="id_kelas" class="form-control <?= ($validation->hasError('id_kelas')) ? 'is-invalid' : ''; ?> " id="id_kelas" value="<?= (old('id_kelas')) ? old('id_kelas') : $home['id_kelas']; ?>" placeholder="Kode Jabatan" readonly>
            <div class="invalid-feedback">
                <?= $validation->getError('id_kelas'); ?>
            </div>

        </div>
        <div class="form-group">
            <label for="nama_kelas">nama kelas</label>
            <input type="text" name="nama_kelas" class="form-control <?= ($validation->hasError('nama_kelas')) ? 'is-invalid' : ''; ?> " id="nama_kelas" value="<?= (old('nama_kelas')) ? old('nama_kelas') : $home['nama_kelas']; ?>" placeholder="Kode Jabatan">
            <div class="invalid-feedback">
                <?= $validation->getError('nama_kelas'); ?>
            </div>

        </div>
        <div class="form-group">
            <label for="kompetensi_keahlian">kopetensi keahlian</label>
            <input type="text" name="kompetensi_keahlian" class="form-control <?= ($validation->hasError('kompetensi_keahlian')) ? 'is-invalid' : ''; ?> " id="kompetensi_keahlian" value="<?= (old('kompetensi_keahlian')) ? old('kompetensi_keahlian') : $home['kompetensi_keahlian']; ?>" placeholder="First name">
            <div class="invalid-feedback">
                <?= $validation->getError('kompetensi_keahlian'); ?>
            </div>

        </div>

        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
    <?= $this->endSection(); ?>
</body>

</html>