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
    <h1 class="mt-2" style="text-align: center;">INPUT DATA PETUGAS / ADMIN</h1>



    <form action="/admin/savepetugas" method="post" style="padding: 20px;" enctype="multipart/form-data">
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
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control  <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?> " id="username" value="<?= old('username'); ?>" placeholder="tulis username anda">
            <div class="invalid-feedback">
                <?= $validation->getError('username'); ?>
            </div>

        </div>
        <div class="form-group">
            <label for="fullname">Full Name</label>
            <input type="text" name="fullname" class="form-control  <?= ($validation->hasError('fullname')) ? 'is-invalid' : ''; ?> " id="fullname" value="<?= old('fullname'); ?>" placeholder="tulis fullname anda">
            <div class="invalid-feedback">
                <?= $validation->getError('fullname'); ?>
            </div>

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
            <select class="selectpicker border <?= ($validation->hasError('id')) ? 'is-invalid' : ''; ?>" data-width="100%" id="id" name="id" value="<?= old('id'); ?>" value="<?= old('id'); ?>" title="Role Admin / Petugas">
                <?php foreach ($role as $r) : ?>
                    <option value="<?= $r['id']; ?>"> <?= $r['name']; ?> </option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
                <?= $validation->getError('id'); ?>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block">Submit</button>
        </div>
    </form>
    <?= $this->endSection(); ?>
</body>

</html>