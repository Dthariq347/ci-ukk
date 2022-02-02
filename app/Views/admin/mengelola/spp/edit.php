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
    <h1 class="mt-2" style="text-align: center;">Edit Data SPP</h1>



    <form action="/admin/updatespp/<?= $home['id_spp']; ?>" method="post" style="padding: 20px;" enctype="multipart/form-data">

        <input type="hidden" name="id_spp" value="<?= $home['id_spp']; ?>">
        <div class="form-group">
            <label for="id_spp">Id SPP</label>
            <input type="text" name="id_spp" class="form-control <?= ($validation->hasError('id_spp')) ? 'is-invalid' : ''; ?> " id="id_spp" value="<?= (old('id_spp')) ? old('id_spp') : $home['id_spp']; ?>" placeholder="Kode Jabatan" readonly>
            <div class="invalid-feedback">
                <?= $validation->getError('id_spp'); ?>
            </div>

        </div>
        <div class="form-group">
            <label for="tahun">Tahun</label>
            <input type="text" name="tahun" class="form-control <?= ($validation->hasError('tahun')) ? 'is-invalid' : ''; ?> " id="tahun" value="<?= (old('tahun')) ? old('tahun') : $home['tahun']; ?>" placeholder="Kode Jabatan">
            <div class="invalid-feedback">
                <?= $validation->getError('tahun'); ?>
            </div>

        </div>
        <div class="form-group">
            <label for="nominal">Nominal</label>
            <input type="text" name="nominal" class="form-control <?= ($validation->hasError('nominal')) ? 'is-invalid' : ''; ?> " id="nominal" value="<?= (old('nominal')) ? old('nominal') : $home['nominal']; ?>" placeholder="First name">
            <div class="invalid-feedback">
                <?= $validation->getError('nominal'); ?>
            </div>

        </div>

        <button type="submit" class="btn btn-success btn-block">Edit</button>
    </form>
    <?= $this->endSection(); ?>
</body>

</html>