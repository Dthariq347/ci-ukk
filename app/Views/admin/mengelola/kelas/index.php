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
    <h1 class="mt-2" style="text-align: center;">INPUT DATA KELAS</h1>



    <form action="/admin/savekelas" method="post" style="padding: 20px;" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="col-sm-10">
            <input type="hidden" name="id_kelas" value="<?= old('id_kelas'); ?>">
        </div>
        <div class="form-group">
            <label for="nama_kelas">NAMA KELAS</label>
            <input type="text" name="nama_kelas" class="form-control  <?= ($validation->hasError('nama_kelas')) ? 'is-invalid' : ''; ?> " id="nama_kelas" value="<?= old('nama_kelas'); ?>" placeholder="tulis nama kelas anda">
            <div class="invalid-feedback">
                <?= $validation->getError('nama_kelas'); ?>
            </div>

        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block">Submit</button>
        </div>
    </form>
    <?= $this->endSection(); ?>
</body>

</html>