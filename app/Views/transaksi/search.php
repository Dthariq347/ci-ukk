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
    <h1 class="mt-2" style="text-align: center;">Search Siswa Untuk Transaksi</h1>



    <form action="/pembayaran/index" method="get" style="padding: 20px;" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="col-sm-10">
            <input type="hidden" name="id_pembayaran" value="<?= old('id_pembayaran'); ?>">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="nisn">Fullname Siswa</label>
            </div>
            <select class="selectpicker border <?= ($validation->hasError('nisn')) ? 'is-invalid' : ''; ?>" data-width="100%" id="nisn" name="nisn" value="<?= old('nisn'); ?>" value="<?= old('nisn'); ?>" data-live-search="true" title="Fullname Siswa....">
                <?php foreach ($nisn as $s) : ?>
                    <option data-subtext="(<?= $s['nis']; ?>)" value="<?= $s['nisn']; ?>"> <?= $s['nama']; ?> </option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
                <?= $validation->getError('nisn'); ?>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block">Submit</button>
        </div>
    </form>
    <?= $this->endSection(); ?>
</body>

</html>