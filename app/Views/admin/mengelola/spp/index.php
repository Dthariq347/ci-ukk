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
    <h1 class="mt-2" style="text-align: center;">INPUT DATA SPP</h1>



    <form action="/admin/savespp" method="post" style="padding: 20px;" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="col-sm-10">
            <input type="hidden" name="id_spp" value="<?= old('id_spp'); ?>">
        </div>
        <div class="form-group">
            <label for="tahun">TAHUN</label>
            <input type="text" name="tahun" class="form-control  <?= ($validation->hasError('tahun')) ? 'is-invalid' : ''; ?> " id="tahun" value="<?= old('tahun'); ?>" placeholder="tulis tahun">
            <div class="invalid-feedback">
                <?= $validation->getError('tahun'); ?>
            </div>

        </div>
        <div class="form-group">
            <label for="nominal">NOMINAL</label>
            <input type="text" name="nominal" class="form-control <?= ($validation->hasError('nominal')) ? 'is-invalid' : ''; ?> " id="nominal" value="<?= old('nominal'); ?>" placeholder="tulis nominal">
            <div class="invalid-feedback">
                <?= $validation->getError('nominal'); ?>
            </div>

        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block" target="_blank">Submit</button>
        </div>
    </form>

    <?= $this->endSection(); ?>
</body>



</html>