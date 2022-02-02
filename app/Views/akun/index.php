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
    <h1 class="mt-2" style="text-align: center;">Pembuatan Akun Siswa</h1>



    <form action="/admin/saveakun" method="post" style="padding: 20px;" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="col-sm-10">
            <input type="hidden" name="id" value="<?= old('id'); ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control  <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?> " id="email" value="<?= old('email'); ?>" placeholder="tulis email anda">
            <div class="invalid-feedback">
                <?= $validation->getError('email'); ?>
            </div>

        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="username">username Siswa</label>
            </div>
            <select class="selectpicker border " data-width="100%" id="username" name="username" value="<?= old('username'); ?>" value="<?= old('username'); ?>" data-live-search="true" title="Username Berdasarkan NIS">
                <?php foreach ($home as $s) : ?>
                    <option data-subtext="(<?= $s['nama']; ?>)" value="<?= $s['nis']; ?>"> <?= $s['nis']; ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="fullname">Fullname Siswa</label>
            </div>
            <select class="selectpicker border " data-width="100%" id="fullname" name="fullname" value="<?= old('fullname'); ?>" value="<?= old('fullname'); ?>" data-live-search="true" title="Fullname Siswa">
                <?php foreach ($home as $s) : ?>
                    <option value="<?= $s['nama']; ?>"> <?= $s['nama']; ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="password_hash">password</label>
            <input type="password" name="password_hash" class="form-control <?= ($validation->hasError('password_hash')) ? 'is-invalid' : ''; ?> " id="password_hash" value="<?= old('password_hash'); ?>" placeholder="tulis password lengkap">
            <div class="invalid-feedback">
                <?= $validation->getError('password_hash'); ?>
            </div>

        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="id">Role</label>
            </div>
            <select class="selectpicker border " data-width="100%" id="id" name="id" value="<?= old('id'); ?>" value="<?= old('id'); ?>" title="Role Siswa">
                <?php foreach ($role as $r) : ?>
                    <option value="<?= $r['id']; ?>"> <?= $r['name']; ?> </option>
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